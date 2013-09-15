<?php
class clicnat_section_archive {
	public function exec($chemin, $smarty) {
		$smarty->display("archive_index.tpl");
	}

	public function menu() {
		return array(
			"chemin"=> "archive",
			"titre" => "Archives",
			"entrees" => array(
				array("chemin" => "classeurs", "titre" => "Dossiers")
			)
		);
	}
}

function clicnat_section_archive() {
	return new clicnat_section_archive();
}
?>
