<?php
require_once("PHPUnit/Autoload.php");
require_once("../core/clicnat_element.php");
require_once("../core/clicnat_utilisateur.php");

class clicnat_utilisateurTest extends PHPUnit_Framework_TestCase {
	public function testPresenceColonnes() {
		$u = new clicnat_utilisateur(1);
		$u->test_presence_proprietes_colonnes();
	}
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

	public function testNomSequence() {
		$table_utilisateur = clicnat_table_db('utilisateurs');
		$nom = $table_utilisateur->nom_sequence_cle_primaire();
		$this->assertNotNull($nom);
	}

	public function testInsertion() {
		$table_utilisateur = clicnat_table_db('utilisateurs');
		$id = $table_utilisateur->id_dernier();
		$this->assertGreaterThan(0, $id);
		$id_suivant = $table_utilisateur->id_suivant();
		$this->assertGreaterThan($id, $id_suivant);
		$id = $id_suivant;

		$data_test = array(
			"nom" => "Doe",
			"prenom" => "John",
			"mail" => "john@doe.com"
		);
		$id_suivant = $table_utilisateur->insert($data_test);
		$this->assertGreaterThan($id, $id_suivant);

		$u = new clicnat_utilisateur($id_suivant);
		$this->assertEquals($u->id_utilisateur, $id_suivant);

	}
}
