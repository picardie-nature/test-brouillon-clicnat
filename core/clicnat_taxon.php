<?php
/*
    Clicnat
    Copyright (C) 2013  Picardie Nature

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

/**
 * @brief taxon d'un référentiel 'officiel'
 */
class clicnat_taxon extends clicnat_element_db {
	protected $id_taxon;
	protected $id_taxon_sup;
	protected $identifiant;
	protected $identifiant_taxon_sup;
	protected $identifiant_taxon_ref;
	protected $nom_scientifique;
	protected $regne;
	protected $embranchement;
	protected $classe;
	protected $ordre;
	protected $famille;
	protected $rang;
	protected $nom_vernaculaire;
	protected $auteur;

	const nom_table = 'taxons';
	const schema = 'public';

	public function __construct($id, $nom_table=self::nom_table, $data=null) {
		$this->table = clicnat_table_db($nom_table);
		parent::__construct($id, $nom_table, $data);
	}

	public static function rechercher($params) {
		return parent::_rechercher($params, self::nom_table, self::schema);
	}

}

?>
