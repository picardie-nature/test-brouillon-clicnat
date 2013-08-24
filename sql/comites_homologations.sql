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

create table comites_homologations (
	id_comite_homologation serial,
	date_creation timestamp default now(),
	date_modif timestamp default null,
	nom varchar(100),
	primary key (id_comite_homologation)
);

create table comites_homologations__utilisateurs (
	id_comite_homologation integer references comites_homologations (id_comite_homologation),
	id_utilisateur integer references utilisateurs (id_utilisateur),
	primary key (id_comite_homologation, id_utilisateur)
);
