<?php
require_once("PHPUnit/Autoload.php");
require_once("../core/clicnat_element.php");

class clicnat_colonne_dbTest extends PHPUnit_Framework_TestCase {
	/**
	 * @expectedException ExPropInconnue
	 */
	public function testException() {
		$args = array(
			"column_name" => "a",
			"data_type" => "b",
			"character_maximum_length" => "c",
			"is_nullable" => "YES"
		);

		$obj = new clicnat_colonne_db($args);

		echo $obj->prop_inconnue;

	}

	public function testConstructeur() {
		$args = array(
			"column_name" => "a",
			"data_type" => "b",
			"character_maximum_length" => "c",
			"is_nullable" => "YES"
		);

		$obj = new clicnat_colonne_db($args);
		
		$this->assertEquals($obj->nom, $args['column_name']);
		$this->assertEquals($obj->type, $args['data_type']);
		$this->assertEquals($obj->lmax_texte, $args['character_maximum_length']);
		$this->assertEquals($obj->null_ok, true);

		$args['is_nullable'] = "NO";

		$obj = new clicnat_colonne_db($args);

		$this->assertEquals($obj->null_ok, false);
	}
}
?>
