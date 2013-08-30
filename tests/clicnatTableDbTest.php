<?php
define('CLICNAT_CHEMIN_CONF', 'config.json');
require_once("PHPUnit/Autoload.php");
require_once("../core/clicnat_element.php");

class clicnat_table_dbTest extends PHPUnit_Framework_TestCase {
	public function testGetTableDb() {
		$obj_a = clicnat_table_db("utilisateurs");
		$this->assertInstanceOf("clicnat_table_db", $obj_a);
	}

	public function testInstanceUtilisateur() {
		$obj = new clicnat_table_db("utilisateurs", "id_utilisateur");
		$this->assertEquals($obj->table, "utilisateurs");
		$this->assertEquals($obj->cle_primaire, "id_utilisateur");
		$this->assertEquals($obj->schema, "public");

		$colonnes = $obj->colonnes();
		$this->assertTrue(is_array($colonnes));
		$this->assertEquals(count($colonnes),21);
	}

	/**
	 * @expectedException ExPropInconnue
	 */
	public function testException() {
		$obj = new clicnat_table_db("utilisateurs", "id_utilisateur");
		echo $obj->prop_inconnue;
	}

}
