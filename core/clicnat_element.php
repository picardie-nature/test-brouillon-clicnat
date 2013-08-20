<?php
/*
    Clicnat
    Copyright (C) 2013  Picardie Nature

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

class ExPropInconnue extends Exception { }
class ExConfiguration extends Exception { }

/**
 * @brief accès à la configuration de l'application
 */
function conf() {
	static $conf;

	if (!isset($conf)) {
		if (!defined('CLICNAT_CHEMIN_CONF')) {
			define('CLICNAT_CHEMIN_CONF', '/etc/clicnat/conf.json');
		}
		if (!file_exists(CLICNAT_CHEMIN_CONF)) {
			throw new ExConfiguration("Le fichier de configuration ".CLICNAT_CHEMIN_CONF." existe pas");
		}
		$conf = json_decode(file_get_contents(CLICNAT_CHEMIN_CONF));
	}

	return $conf;
}

/**
 * @brief gestionnaire de connection avec la base de données
 * @return PDO
 */
function db() {
	static $dbh;

	if (!isset($dbh)) {
		$dbh = new PDO(conf()->pdo_pgsql_dsn);
	}

	return $dbh;
}


/**
 * @brief une ligne d'une table 
 *
 * chaque table est associée à une classe dérivée cette classe
 */
abstract class clicnat_element_db {
	protected $table;

	/**
	 * @brief constructeur
	 * @param $nom_table classe dérivée de clicnat_table_db
	 * @param $id identifiant de la ressource a extraire
	 * @param $data données de l'objet évite au constructeur de faire la requête, l'id peut être omis
	 */
	public function __construct($id, $nom_table, $data=null) {
		$this->table = clicnat_table_db($nom_table);
		if (!is_array($data)) {
			$q = db()->prepare("select * from {$this->table->table} where {$this->table->cle_primaire} = ?");
			$q->execute(array($id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
		}
		foreach ($data as $k=>$v)
			$this->$k = $v;
	}

	public function enregistre($champ, $valeur) {
		if ($this->table->enregistre($this->id(), $champ, $valeur)) {
			$this->$champ = $valeur;
			return true;
		}
		return false;
	}

	public function id() {
		return $this->{$this->table->cle_primaire};
	}
}

/**
 * @brief une table de la base de données
 */
class clicnat_table_db {
	protected $table;
	protected $cle_primaire;
	protected $schema;

	protected $colonnes;

	const sql_colonnes = 'select column_name,data_type,character_maximum_length,is_nullable from information_schema.columns where table_schema=? and table_name=?';
	
	public function __construct($table, $cle_primaire, $schema="public") {
		$this->table = $table;
		$this->cle_primaire = $cle_primaire;
		$this->schema = $schema;
	}

	public function __get($c) {
		switch ($c) {
			case 'table': return $this->table;
			case 'cle_primaire': return $this->cle_primaire;
			case 'schema': return $this->schema;
		}
		throw new ExPropInconnue($c);
	}

	public function colonnes() {
		if (!isset($this->colonnes)) {
			$this->colonnes = array();
			$req = db()->prepare(self::sql_colonnes);
			$req->execute(array($this->schema, $this->table));
			foreach ($req->fetchAll() as $tc)
				$this->colonnes[] = new clicnat_colonne_db($tc);
		}
		return $this->colonnes;
	}

	public function enregistre($id, $colonne, $valeur) {
		if (empty($id))
			throw new Exception("pas d'identifiant");
		$req = db()->prepare("update {$this->table} set $colonne = ? where {$this->cle_primaire} = ?");
		$req->execute(array($valeur, $id));
		if ($req->rowCount()==0) {
			throw new Exception("aucune mise à jour enregistrée {$req->errorCode()}");
		}
		return true;
	}
}

class clicnat_colonne_db {
	protected $nom;
	protected $type;
	protected $lmax_texte;
	protected $null_ok;

	function __construct($args) {
		$this->nom = $args['column_name'];
		$this->type = $args['data_type'];
		$this->lmax_texte = $args['character_maximum_length'];
		$this->null_ok = $args['is_nullable'] == 'YES';
	}

	function __get($c) {
		switch ($c) {
			case 'nom':
			case 'type':
			case 'lmax_texte':
			case 'null_ok':
				return $this->$c;
		}
		throw new ExPropInconnue($c);
	}
}

function clicnat_table_db($table) {
	static $instances;

	if (!isset($instances))
		$instances = array();
	
	if (!isset($instances[$table])) {
		$schema = "public";
		switch ($table) {
			case 'utilisateurs':
				$cle_primaire = "id_utilisateur";
				break;
			default:
				throw new Exception("Table inconnue $table");
		}

		$instances[$table] = new clicnat_table_db($table, $cle_primaire, $schema);
	}

	return $instances[$table];
}
?>
