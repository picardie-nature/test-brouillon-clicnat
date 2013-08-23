<?php
require_once("PHPUnit/Autoload.php");
require_once("../core/clicnat_element.php");
require_once("../core/clicnat_utilisateur.php");

class clicnat_taxonTest extends PHPUnit_Framework_TestCase {
	public function testInsertion() {
		$data = array(
			"id_taxon_sup" => 42,
			"identifiant" => "taxref.exemple.v0.32",
			"identifiant_taxon_sup" => "taxref.exemple.v0.30",
			"identifiant_taxon_ref" => "taxref.exemple.v0.32",
			"nom_scientifique" => "nom scientifique",
			"regne" => "Regne",
			"embranchement" =>  "Embranchement",
			"classe" => "Classe",
			"ordre" => "Ordre",
			"famille" => "Famille",
			"rang" => "Rang",
			"nom_vernaculaire" => "Nom vernaculaire",
			"auteur" => "Auteur du taxon"
		);
		clicnat_table_db('taxons')->insert($data);
	}
}

?>
