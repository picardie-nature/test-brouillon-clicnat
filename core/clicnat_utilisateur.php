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
	protected $nouvel_observateur;

	public function __construct($id, $nom_table='utilisateurs', $data=null) {
		$this->table = clicnat_table_db($nom_table);
		parent::__construct($id, $nom_table, $data);
	}

	public function __toString() {
		return trim("{$this->nom} {$this->prenom}");
	}
	
	public function __get($c) {
		switch ($c) {
			case 'pseudo':
				return $this->pseudo;
			case 'derniere_connexion':
				return $this->derniere_connexion;
		}
	}

	public function crypte_mot_de_passe($mdp) {
		return hash('sha256', "{$mdp}§{$this->id_utilisateur}");
	}

	public function connexion($mdp) {
		if (self::crypte_mot_de_passe($mdp) == $this->mot_de_passe) {
			$this->enregistre('derniere_connexion', strftime("%Y-%m-%d %H:%M:%S"));
			return true;
		}
		return false;
	}

	/**
	 * @brief recherche d'utilisateurs
	 * @params $args un tableau cle/valeur, la clé doit correspondre a un champ
	 * @return clicnat_iter_utilisateur
	 * @todo
	 */
	static public function rechercher($args) {
	}

	/**
	 * @brief recherche d'utilisateurs basée sur le nom et le prénom
	 * $params $txt le texte avec le nom et le prénom
	 * @return clicnat_iter_utilisateur
	 * @todo
	 */
	static public function rechercher_utilisateur($str) {
	}

	/**
	 * @brief personnes avec qui l'observateur observe
	 * @return clicnat_iter_utilisateur
	 * @todo
	 */
	public function co_observateurs() {
	}

	/**
	 * @brief nombre d'observations enregistrées
	 * @return int
	 * @todo
	 */
	public function n_observations() {
	}

	/**
	 * @brief nombre d'observations saisies par l'utilisateur
	 * @return int
	 * @todo
	 */
	public function n_observations_saisies() {
	}

	/**
	 * @brief nombre de citations enregistrées
	 * @return int
	 * @todo
	 */
	public function n_citations() {
	}

	/**
	 * @brief nombre de citations saisies par l'utilisateur
	 * @return int
	 * @todo
	 */
	public function n_citations_saisies() {
	}

	/**
	 * @brief nombre de citations avec une étiquette
	 * @param $etiquette clicnat_etiquette
	 * @return int
	 * @todo
	 */
	public function n_citations_avec_etiquette($etiquette) {
	}

	/**
	 * @brief date de la première observation
	 * @return clicnat_date
	 * @todo
	 */
	public function premiere_date_obs() {
	}

	/**
	 * @brief date de la dernière observation
	 * @return clicnat_date
	 * @todo
	 */
	public function derniere_date_obs() {
	}

	/**
	 * @brief liste des espèces vues
	 * @return clicnat_it_espece
	 * @todo
	 */
	public function especes_vues() {
	}

	/**
	 * @brief mise à disposition des données
	 * @return bool
	 * @todo
	 *
	 * Lister les id_citation que l'observateur peut consulter et
	 * l'enregistrer dans une table
	 */
	public function mise_a_disposition_des_donnees() {
	}

	/**
	 * @brief test si l'utilisateur peut voir
	 * @param $obj objet clicnat_citation ou clicnat_observation
	 * @return bool
	 * @todo
	 */
	public function peut_consulter($obj) {
	}

	/**
	 * @brief test si l'utilisateur peut modifier
	 * @param $obj objet clicnat_citation ou clicnat_observation
	 * @return bool
	 * @todo
	 */
	public function peut_modifier($obj) {
	}

	/**
	 * @brief liste des listes de citations de l'utilisateur
	 * @return clicnat_it_listes_citations
	 * @todo
	 */
	public function listes_citations() {
	}

	/**
	 * @brief liste des listes d'espaces de l'utilisateur
	 * @return clicnat_it_listes_espaces
	 * @todo
	 */
	public function listes_espaces() {
	}

	/**
	 * @brief liste des listes d'espèces de l'utilisateur
	 * @return clicnat_it_listes_especes
	 * @todo
	 */
	public function listes_especes() {
	}

	/**
	 * @brief liste des observations pas encore envoyées
	 * @return clicnat_it_observations
	 * @todo
	 */
	public function observations_brouillard() {
	}

	/**
	 * @brief liste des imports
	 * @return clicnat_it_imports
	 * @todo
	 */
	public function imports() {
	}

	/**
	 * @brief envoi lien nouveau mot de passe
	 * @return bool
	 * @todo
	 */
	public function envoi_ticket_recup_mot_de_passe() {
	}

	/**
	 * @brief liste les structures auxquels appartient l'utilisateur
	 * @return clicnat_it_structures
	 * @todo
	 */
	public function structures() {
	}

	/**
	 * @brief nombre d'observateurs dans la base
	 * @param $annee avec une observation entre $annee et aujourd'hui
	 * @return int
	 * @todo
	 */
	static function n_observateurs($annee=false) {
	}

	/**
	 * @brief réseaux dont l'observateur est membre
	 * @return clicnat_it_reseaux
	 * @todo
	 */
	public function reseaux() {
	}

	/**
	 * @brief test si l'observateur est membre
	 * @param $reseau objet clicnat_reseau
	 * @return bool
	 * @todo
	 */
	public function membre_reseau($reseau) {
	}

	/**
	 * @brief requetes enregistrées de l'utilisateur
	 * @return clicnat_it_requetes
	 * @todo
	 */
	public function requetes() {
	}
}
?>
