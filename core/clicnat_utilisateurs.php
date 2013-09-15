<?php
/**
 * @brief liste d'utilisateurs
 */
class clicnat_utilisateurs extends clicnat_table_iterateur {
	/**
	 * @brief constructeur
	 */
	public function __construct() {
		parent::__construct("utilisateurs");
	}

	public function current() {
		clicnat_utilisateur::instance($this->ids[$this->position]);
	}
}
?>
