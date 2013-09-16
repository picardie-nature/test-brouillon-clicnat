<?php
$client = new Mongo("mongodb://127.0.0.1");
$dbname = "biblio";
$db = $client->$dbname;

$f = fopen("php://stdin", "r");
while ($l = fgets($f)) {
	$l = trim($l);
	$metadata = array("doc_type" => "document", "id_biblio_document" => str_replace(".pdf", "", basename($l)));
	echo "** $l **\n";
	$grid = $db->getGridFs();
	$id = $grid->storeFile($l, $metadata);
	echo "\t$id\n";
}
?>
