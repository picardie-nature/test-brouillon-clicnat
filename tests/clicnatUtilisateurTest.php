<?php
require_once("PHPUnit/Autoload.php");
require_once("../core/clicnat_element.php");
require_once("../core/clicnat_utilisateur.php");

class clicnat_utilistateurTest extends PHPUnit_Framework_TestCase {
	public function testMotdePasse() {
		$u = new clicnat_utilisateur(1);
		
		// test vérification du mot de passe
		$this->assertFalse($u->connexion("mauvais_mot_de_passe"));
		$this->assertTrue($u->connexion("admin"));
	}

	public function testMisesAjours() {
		$u = new clicnat_utilisateur(1);
		$backup_date = strtotime($u->derniere_connexion);
		// test enregistrement derniere connexion
		sleep(3);
		$this->assertTrue($u->connexion("admin"));
		$nouvelle_date = strtotime($u->derniere_connexion);
		$this->assertGreaterThanOrEqual(3, $nouvelle_date-$backup_date);

		// date de modification bien mise a jour
		$derniere_modif = strtotime($u->date_modif);
		$this->assertGreaterThanOrEqual(3, $derniere_modif);
		// enregistrer un pseudo
		$this->assertTrue($u->enregistre("pseudo", "un_pseudo"));
		$this->assertEquals("un_pseudo", $u->pseudo);
	}

	public function testToString() {
		$u = new clicnat_utilisateur(1);
		// test toString
		$this->assertEquals($u->__toString(), "admin");
	}
}
