<?php
class clicnat_biblio_document extends clicnat_element_db {
	protected $id_biblio_document;
	protected $titre;
	protected $annee_publi;
	protected $doc_path;
	protected $nb_pages;

	const nom_table = 'biblio_document';
	const schema = 'public';

	public function __construct($id, $nom_table=self::nom_table, $data=null) {
		$this->table = clicnat_table_db::instance($nom_table);
		parent::__construct($id, $nom_table, $data);
	}

	public function __toString() {
		return $this->titre;
	}
}
?>
