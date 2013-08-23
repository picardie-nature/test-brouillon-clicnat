<?php
define('CLICNAT_CHEMIN_CONF','../../config.json');
require_once('../../core/clicnat_element.php');
require_once('../../core/clicnat_taxon.php');
$f = fopen("php://stdin", "r");
$noms_colonnes = null;
while ($l = fgets($f)) {
	$src = explode("\t", iconv('latin1','utf-8',trim($l)));
	$table = clicnat_table_db('taxons');
	if (is_null($noms_colonnes)) {
		$noms_colonnes = $src;
	} else {
		$taxon = array();
		foreach ($src as $n_col => $val) {
			switch ($noms_colonnes[$n_col]) {
				case 'CD_NOM':
					$taxon['identifiant'] = "taxref.v6.$val";
					break;
				case 'CD_TAXSUP':
					$taxon['identifiant_taxon_sup'] = "taxref.v6.$val";
					break;
				case 'CD_REF':
					$taxon['identifiant_taxon_ref'] = "taxref.v6.$val";
					break;
				case 'LB_NOM':
					$taxon['nom_scientifique'] = $val;
					break;
				case 'REGNE':
					$taxon['regne'] = $val;
					break;
				case 'PHYLUM':
					$taxon['embranchement'] = $val;
					break;
				case 'CLASSE':
					$taxon['classe'] = $val;
					break;
				case 'ORDRE':
					$taxon['ordre'] = $val;
					break;
				case 'FAMILLE':
					$taxon['famille'] = $val;
					break;
				case 'RANG':
					$taxon['rang'] = $val;
					break;
				case 'NOM_VERNACULAIRE':
					$taxon['nom_vernaculaire'] = $val;
					break;
				case 'LB_AUTEUR':
					$taxon['auteur'] = $val;
					break;
					
			}
		}
		$table->insert($taxon);
	}
}
?>
