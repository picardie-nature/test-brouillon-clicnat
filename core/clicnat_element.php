<?php

/**
 * @brief accès à la configuration de l'application
 */
function conf() {
	static $conf;

	if (!isset($conf)) {
		if (!defined('CLICNAT_CHEMIN_CONF')) {
			define('CLICNAT_CHEMIN_CONF', '/etc/clicnat/conf.json');
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
	/**
	 * @brief constructeur
	 * @param $table classe dérivée de clicnat_table_db
	 * @param $id identifiant de la ressource a extraire
	 * @param $data données de l'objet évite au constructeur de faire la requête, l'id peut être omis
	 */
	public function __construct($table, $id, $data=null) {
	}
}

/**
 * @brief une table de la base de données
 *
 * chaque table est associée à une classe dérivée cette classe
 */
abstract class clicnat_table_db {
	protected $table;
	protected $cle_primaire;
	protected $schema;

	protected $colonnes;

	const sql_colonnes = 'select column_name,data_type,character_maximum_length,is_nullable from information_schema.columns where table_schema=? table_name=?';
	
	public function __construct($table, $cle_primaire, $schema="public") {
		$this->table = $table;
		$this->cle_primaire = $cle_primaire;
		$this->schema = $schema;
	}

	public function colonnes() {
		if (!isset($colonnes)) {
			$q = $db()->prepare(self::sql_colonnes);
			$q->execute(array($this->schema, $this->table));
			//...
		}
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
}
?>
