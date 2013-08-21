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

create type t_utilisateurs_loc_visible as enum ('restreint', 'reseau', 'tous');

create table utilisateurs (
        id_utilisateur serial not null,
        nom character varying(150) not null,
        prenom character varying(150),
	pseudo varchar(150),
        identifiant character varying(50),
        mot_de_passe character varying(64),
        tel character varying(30),
        port character varying(30),
        fax character varying(30),
        mail character varying(100) unique,
        url character varying(100),
        acces_qg boolean not null default false,
        acces_chiros boolean not null default false,
        reglement_date_sig date default null,
        derniere_connexion timestamp default null,
        the_geom geometry, -- todo utiliser la fonction postgis
        localisation_visible t_utilisateurs_loc_visible not null default ('restreint'),
	options text,
	nouvel_observateur boolean default false,
	date_creation timestamp default now(),
	date_modif timestamp default null,
	primary key (id_utilisateur)
);

insert into utilisateurs (nom,identifiant,mot_de_passe)
values ('admin','admin','f5446b430c5cb61fe77dd2f446d444b9652471baccb303388945954de52e1300');

