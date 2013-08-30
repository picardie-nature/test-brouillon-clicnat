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
class ExErreurRequeteSQL extends Exception {
	public function __construct($req, $code = 0, Exception $previous = null) {
		parent::__construct($req->errorInfo()[2], $req->errorCode(), $previous);
	}
}
class ExPasTrouve extends Exception { 
	public function __construct($table, $id) {
		parent::__construct("Pas trouvé d'élément $id dans la table $table");
	}
}

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

	protected $date_creation;
	protected $date_modif;

	protected $date_instance;

	/**
	 * @brief constructeur
	 * @param $nom_table classe dérivée de clicnat_table_db
	 * @param $id identifiant de la ressource a extraire
	 * @param $data données de l'objet évite au constructeur de faire la requête, l'id peut être omis
	 */
	public function __construct($id, $nom_table, $data=null) {
		$this->date_instance = time();
		$this->table = clicnat_table_db($nom_table);
		if (!is_array($data)) {
			$q = db()->prepare("select * from {$this->table->table} where {$this->table->cle_primaire} = ?");
			if (!$q->execute(array($id))) {
				throw new ExErreurRequeteSQL($req);
			}
			$data = $q->fetch(PDO::FETCH_ASSOC);
		}
		if ($q->rowCount() != 1) {
			throw new ExPasTrouve($nom_table, $id);
		}
		foreach ($data as $k=>$v) {
			$this->$k = $v;
		}
	}

	public static function instance($id) {
		static $instances;
		static $instances_liste;

		$classe = get_called_class();

		if (!isset($instances_liste)) $instances_liste = array();
		if (!isset($instances)) $instances = array();
		if (!isset($instances[$classe])) $instances[$classe] = array();
		if (!isset($instances[$classe][$id])) {
			$instances_liste[] = $instances[$classe][$id] = new $classe($id);
		}
		
		return $instances[$classe][$id];
	}

	/**
	 * @brief mise à jour d'une colonne
	 * @param $colonne nom de la colonne
	 * @param $valeur valeur a enregistrer
	 * @return bool
	 */
	public function enregistre($colonne, $valeur) {
		if ($this->table->enregistre($this->id(), $colonne, $valeur)) {
			$this->$colonne = $valeur;
			return true;
		}
		return false;
	}

	/**
	 * @brief numéro d'identifiant de l'objet
	 * @return int
	 */
	public function id() {
		return $this->{$this->table->cle_primaire};
	}

	/**
	 * @brief accès aux propriétés en lecture seule
	 */
	public function __get($colonne) {
		$colonnes = $this->table->colonnes();
		if (array_key_exists($colonne, $colonnes) === false) {
			if ($colonne == "date_instance")
				return $this->date_instance;

			throw new ExPropInconnue($colonne);
		}
		return $this->$colonne;
	}

	/**
	 * @brief test l'existance de toutes les colonnes de la table en tant que propriétés
	 * @return bool
	 */
	public function test_presence_proprietes_colonnes() {
		foreach ($this->table->colonnes() as $colonne) {
			if (!property_exists(get_class($this), $colonne->nom)) {
				throw new Exception("la colonne {$colonne->nom} n'est pas représentée par une propriété");
			}
		}
		return true;
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

	const sql_colonnes = 'select column_name,data_type,character_maximum_length,is_nullable,column_default
			from information_schema.columns where table_schema=? and table_name=?';
	
	/**
	 * @brief constructeur
	 * @param $table nom de la table
	 * @param $cle_primaire nom de la colonne qui est la clé primaire
	 * @param $schema schema si différent de public
	 */
	public function __construct($table, $cle_primaire, $schema="public") {
		$this->table = $table;
		$this->cle_primaire = $cle_primaire;
		$this->schema = $schema;
	}

	/**
	 * @brief accès en lecture seule à certaines propriétés
	 * @param $c nom de la propriété
	 */
	public function __get($c) {
		switch ($c) {
			case 'table': return $this->table;
			case 'cle_primaire': return $this->cle_primaire;
			case 'schema': return $this->schema;
		}
		throw new ExPropInconnue($c);
	}

	/**
	 * @brief colonnes de la table
	 * @return array clicnat_colonne_db
	 */
	public function colonnes() {
		if (!isset($this->colonnes)) {
			$this->colonnes = array();
			$req = db()->prepare(self::sql_colonnes);
			$req->execute(array($this->schema, $this->table));
			foreach ($req->fetchAll() as $tc) {
				$this->colonnes[$tc['column_name']] = new clicnat_colonne_db($tc);
			}
		}
		return $this->colonnes;
	}

	/**
	 * @brief insertion d'une nouvelle ligne dans la table
	 * @param $colonnes un tableau clé valeurs du contenu a insérer
	 * @return int id de l'objet inséré 
	 */
	public function insert($colonnes) {
		$colonnes[$this->cle_primaire] = $this->id_suivant();
		$nom_cols = "";
		$valeurs = "";
		$tab_valeurs = array();
		foreach ($colonnes as $colonne => $valeur) {
			$nom_cols .= "$colonne,";
			$valeurs .= "?,";
			$tab_valeurs[] = $valeur;
		}
		$nom_cols = trim($nom_cols,",");
		$valeurs = trim($valeurs,",");
		$req = db()->prepare("insert into {$this->table} ($nom_cols,date_creation) values ($valeurs,now())");
		if (!$req->execute($tab_valeurs)) {
			throw new ExErreurRequeteSQL($req);
		}
		return $colonnes[$this->cle_primaire];
	}

	/**
	 * @brief mise à jour d'une colonne
	 * @param $id numéro d'identifiant de la ligne a mettre à jour
	 * @param $colonne nom de la colonne
	 * @param $valeur contenu
	 * @return bool
	 */
	public function enregistre($id, $colonne, $valeur) {
		if (empty($id))
			throw new Exception("pas d'identifiant");
		$req = db()->prepare("update {$this->table} set $colonne = ?, date_modif=now() where {$this->cle_primaire} = ?");
		if (!$req->execute(array($valeur, $id))) {
			throw new ExErreurRequeteSQL($req);
		}
		if ($req->rowCount()==0) {
			throw new Exception("aucune mise à jour enregistrée {$req->errorCode()}");
		}
		return true;
	}

	const sql_select_id_suivant = 'select nextval(?) as id';
	const sql_select_id_dernier = 'select last_value from "?"';

	/**
	 * @brief nom de la séquence de la clé primaire
	 * @return string
	 */
	public function nom_sequence_cle_primaire() {
		$nom_sequence = null;
		$sequence = $this->colonnes()[$this->cle_primaire]->valeur_par_defaut;
		if (preg_match("/^nextval\('(.*)'::regclass\)/", $sequence, $m)) {
			$nom_sequence = $m[1];
		} else {
			throw new Exception("la valeur par défaut ressemble pas à une séquence");
		}
		return $nom_sequence;
	}

	/**
	 * @brief extrait l'id suivant (nextval)
	 * @return int
	 */
	public function id_suivant() {
		$req = db()->prepare(self::sql_select_id_suivant);
		if (!$req->execute(array($this->nom_sequence_cle_primaire()))) {
			throw new ExErreurRequeteSQL($req);
		}
		return $req->fetch()['id'];
	}

	/**
	 * @brief dernier id distribué par la séquence
	 * @return int
	 */
	public function id_dernier() {
		$req = db()->prepare(sprintf("select last_value from \"%s\"",$this->nom_sequence_cle_primaire()));
		if (!$req->execute(array())) {
			throw new ExErreurRequeteSQL($req);
		}
		return $req->fetch()['last_value'];
	}
}

/**
 * @brief colonne d'une table
 */
class clicnat_colonne_db {
	protected $nom;
	protected $type;
	protected $lmax_texte;
	protected $null_ok;
	protected $valeur_par_defaut;

	/**
	 * @brief constructeur
	 * @param $args tableau resultat de la requête sur le schema
	 */
	function __construct($args) {
		$this->nom = $args['column_name'];
		$this->type = $args['data_type'];
		$this->lmax_texte = $args['character_maximum_length'];
		$this->null_ok = $args['is_nullable'] == 'YES';
		$this->valeur_par_defaut = $args['column_default'];
	}

	/**
	 * @brief accès aux propriétés en lecture seule
	 * @param $c nom de la propriété
	 * @return valeur de la propriété
	 */
	function __get($c) {
		switch ($c) {
			case 'nom':
			case 'type':
			case 'lmax_texte':
			case 'null_ok':
			case 'valeur_par_defaut':
				return $this->$c;
		}
		throw new ExPropInconnue($c);
	}
}

/**
 * @brief singleton d'une table
 * @param $table nom de la table
 * @return instance de clicnat_table_db
 */
function clicnat_table_db($table, $schema="public") {
	static $instances;

	if (!isset($instances))
		$instances = array();
	
	if (!isset($instances["$schema.$table"])) {
		switch ($table) {
			case 'utilisateurs':
				$cle_primaire = "id_utilisateur";
				break;
			case 'especes':
				$cle_primaire = "id_espece";
				break;
			case 'taxons':
				$cle_primaire = "id_taxon";
				break;
			default:
				throw new Exception("Table inconnue $table");
		}

		$instances["$schema.$table"] = new clicnat_table_db($table, $cle_primaire, $schema);
	}

	return $instances["$schema.$table"];
}
?>
