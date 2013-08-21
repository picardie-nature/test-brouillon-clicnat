-- /*
--  * Script d'installation de la base de données
--  */
-- Créé le DATE sur HOSTNAME
-- postgre_dir=POSTGRE_DIR
-- postgis_dir=POSTGIS_DIR
-- postgis_ver=POSTGIS_VER
-- postgis_ver_maj=POSTGIS_VER_MAJ

#if DROPDB == 1
drop database NOMDB;
#endif

-- création de la base
create database NOMDB;
\connect NOMDB

create language plpgsql;

-- installation de postgis
\i POSTGIS_DIR/postgis.sql 
\i POSTGIS_DIR/spatial_ref_sys.sql

-- rester compatible
#if POSTGIS_VER_MAJ > 1
\i POSTGIS_DIR/legacy.sql
#endif

-- creation des tables
#include <utilisateurs.sql>
#include <especes.sql>
