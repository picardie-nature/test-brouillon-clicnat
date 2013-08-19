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
 * @brief utilisateur de la base de donnée
 */
class clicnat_utilisateur extends clicnat_element_db {
	protected $id_utilisateur;
	protected $nom;
	protected $prenom;
	protected $pseudo;
	protected $login;
	protected $mot_de_passe;
	protected $tel;
	protected $port;
	protected $fax;
	protected $mail;
	protected $url;
	protected $acces_qg;
	protected $acces_chiros;
	protected $reglement_date_sig;
	protected $derniere_connexion;
	protected $localisation_visible;
	protected $options;

	public function __construct($id, $nom_table='utilisateurs', $data=null) {
		$this->table = clicnat_table_db($nom_table);
		parent::__construct($id, $nom_table, $data);
	}

	public function __toString() {
		return "{$this->nom} {$this->prenom}";
	}

	public function crypte_mot_de_passe($mdp) {
		return hash('sha256', "{$mdp}§{$this->id_utilisateur}");
	}

	public function connexion($mdp) {
		if (self::crypte_mot_de_passe($mdp) == $this->mot_de_passe) {
			// maj derniere connexion
		}
	}
}
?>
