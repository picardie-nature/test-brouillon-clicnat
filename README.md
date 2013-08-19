Clicnat
=======

Ce projet est une publication du code de Clicnat utilisé par Picardie Nature.

Le code du noyau est remanié et débarassé des spécificités développées pour la version Picarde de l'application.
Pas mal d'éléments seront aussi rendu paramétrable.

Les vues et les contrôleurs seront refait à partir de zéro.

En l'état, il n'y a rien d'utilisable, les contributions sont les bienvenues.


### Création de la base de données pour développer
$ sudo su postgres
$ psql
sql> create database clicnat\_test;

Éditez le fichier pg\_hba.conf et ajouter ces deux lignes
local   clicnat\_test	votreLogin	peer
local   clicnat\_test	www-data	peer

$ psql clicnat\_test -f /usr/share/postgresql/9.1/contrib/postgis-2.0/postgis.sql
$ psql clicnat\_test -f /usr/share/postgresql/9.1/contrib/postgis-2.0/legacy.sql
$ psql clicnat\_test -f /usr/share/postgresql/9.1/contrib/postgis-2.0/spatial_ref_sys.sql

