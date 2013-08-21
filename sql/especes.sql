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

create table taxons (
	id_taxon serial,	
	date_creation timestamp default now(),
	date_modif timestamp default null,

	-- todo ajouter identifiant unique gbif

	-- http://rs.tdwg.org/dwc/terms/index.htm#scientificName
	nom_scientifique varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#kingdom
	reigne varchar(10),

	-- http://rs.tdwg.org/dwc/terms/index.htm#phylum
	embranchement varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#class
	classe varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#ordre
	ordre varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#family
	famille varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#genus
	genre varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#subgenus
	sous_genre varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#taxonRank
	-- http://code.google.com/p/darwincore/wiki/Taxon#taxonRank
	rang varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#vernacularName
	nom_vernaculaire varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#scientificNameAuthorship
	auteur varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#taxonomicStatus
	statut varchar(100),

	primary key (id_taxon)
);

create table especes (
	id_espece serial,
	date_creation timestamp default now(),
	date_modif timestamp default null,

	-- taxon actuelle en vigueur
	id_taxon integer references taxons (id_taxon),

	-- http://rs.tdwg.org/dwc/terms/index.htm#scientificName
	nom_scientifique varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#kingdom
	reigne varchar(10),

	-- http://rs.tdwg.org/dwc/terms/index.htm#phylum
	embranchement varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#class
	classe varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#ordre
	ordre varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#family
	famille varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#genus
	genre varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#subgenus
	sous_genre varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#taxonRank
	-- http://code.google.com/p/darwincore/wiki/Taxon#taxonRank
	rang varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#vernacularName
	nom_vernaculaire varchar(100),

	-- http://rs.tdwg.org/dwc/terms/index.htm#scientificNameAuthorship
	auteur varchar(100),

	primary key (id_espece)
);
