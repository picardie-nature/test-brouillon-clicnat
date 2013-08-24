--  Clicnat
--  Copyright (C) 2013  Picardie Nature
--
--  This program is free software; you can redistribute it and/or modify
--  it under the terms of the GNU General Public License as published by
--  the Free Software Foundation; either version 2 of the License, or
--  any later version.
--
--  This program is distributed in the hope that it will be useful,
--  but WITHOUT ANY WARRANTY; without even the implied warranty of
--  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
--  GNU General Public License for more details.
--
--  You should have received a copy of the GNU General Public License along
--  with this program; if not, write to the Free Software Foundation, Inc.,
--  51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

-- ATTENTION : AU STADE DE BROUILLON !

-- table taxons : 
--   contient tous les taxons disponible
--   elle contient les taxons de référence provenant de d'autres bases
--   todo: langue du nom vernaculaire
--
-- table especes : 
--   elle maintient l'association entre la citation et les taxons
--   id_espece associé a une observation est figé, c'est l'id_taxon qui
--   est modifié.
--
--   un champ taxon original peut être ajouté sur la table de la citation
--   et définit au moment du premier changement
--
--   id_taxon peut être null, mais c'est mal cependant si ont veux que la
--   table taxons ne contiennent que des listes de références
--
--   afin de pouvoir naviguer dans les espèces la table especes devra être
--   complètée pour pouvoir atteindre tous les rangs des taxons enregistrés
--   ça permettra aussi de faire des cartes de répartition sur tous les
--   rangs.
--
-- à propos des synonymes : logiquement, tous les synonymes d'une espèce
-- doivent se trouver dans la table taxons. Le hic c'est pour les
-- synonymes de noms vernaculaires qui peuvent être plusieurs et dans
-- plusieurs langues... todo

-- les référentiels officiels
create table taxons (
	id_taxon serial, -- interne a clicnat
	id_taxon_sup integer, -- taxon superieur calculé depuis

	date_creation timestamp default now(),
	date_modif timestamp default null,

	-- * identifiant unique
	--   taxref CD_NOM
	--   gbif   taxonID
	identifiant varchar(200) unique, -- taxref.v6.cd_nom.42	
	
	-- * identifiant taxon sup
	--   taxref CD_TAXSUP
	--   gbif   parentNameUsageID
	identifiant_taxon_sup varchar(200),

	-- * identifiant du taxon de référence
	--   taxref CD_REF
	--   gbif   acceptedNameUsageID
	identifiant_taxon_ref varchar(200),
	
	-- * nom scientifique du taxon
	--   taxref LB_NOM
	--   gbif   scientificName
	nom_scientifique text,

	-- * regne du taxon
	--   taxref REGNE
	--   gbif   kingdom
	regne text,

	-- * Embranchement ou phylum
	--   taxref PHYLUM
	--   gbif   phylum
	embranchement text, -- aka phylum

	-- * Classe du taxon
	--   taxref CLASSE
	--   gbif   class
	classe text,

	-- * Ordre du taxon
	--   taxref ORDRE
	--   gbif   order
	ordre text,

	-- * Famille
	--   taxref FAMILLE
	--   gbif   family
	famille text,

	-- * Rang du taxon
	--   taxref RANG
	--   gbif   taxonRank
	-- peut être en fait un type pour contrôler les valeurs fournies ici
	-- https://github.com/picardie-nature/clicnat/tree/master/referentiels/taxref#valeurs-de-la-colonne-rang
	-- http://rs.tdwg.org/dwc/terms/index.htm#taxonRank
	-- http://code.google.com/p/darwincore/wiki/Taxon#taxonRank
	-- 
	rang text,

        -- * Nom vernaculaire du taxon
	--   taxref NOM_VERN et NOM_VERN_ENG
	--   gbif   vernacularName
	-- ils peuvent être plusieurs et dans plusieurs langues
	-- peut être un tableau avec un type composé ?
	-- http://rs.tdwg.org/dwc/terms/index.htm#vernacularName
	nom_vernaculaire text,

	-- * Auteur du taxon
	--   taxref LB_AUTEUR
	--   gbif   scientificNameAuthorship
	-- http://rs.tdwg.org/dwc/terms/index.htm#scientificNameAuthorship
	auteur text,

	primary key (id_taxon)
);

-- le référentiel de la base
create table especes (
	id_espece serial,
	date_creation timestamp default now(),
	date_modif timestamp default null,

	id_espece_sup integer references especes(id_espece),

	nom_scientifique varchar(100),
	auteur varchar(100),
	nom_vernaculaire varchar(100),

	regne varchar(10),
	embranchement varchar(100),
	classe varchar(100),
	ordre varchar(100),
	famille varchar(100),
	
	rang varchar(100),
	primary key (id_espece)
);

-- associations référentiel de la base avec référentiels officiels
create table especes_taxons (
	id_espece integer references especes (id_espece),
	id_taxon integer references taxons (id_taxon)
);

