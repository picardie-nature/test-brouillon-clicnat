<?php
require_once("PHPUnit/Autoload.php");
require_once("../core/clicnat_element.php");
require_once("../core/clicnat_utilisateur.php");
require_once("../core/clicnat_utilisateurs.php");

class clicnat_utilisateursTest extends PHPUnit_Framework_TestCase {
	public function testIterateur() {
		$liste = new clicnat_utilisateurs();
		$liste->identifiants(array("1"));
		foreach ($liste as $e) {
			$this->assertEquals($liste->id() == "1");
		}
	}
}
