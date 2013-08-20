Création de la base de données
==============================

La première fois vous pouvez lancer comme ci-dessous avec un utilisateur ayant un rôle administrateur (voir plus bas).

    make install NOMDB=clicnat_dev

Si vous souhaitez recréer votre base (efface toutes les données !)

    make install NOMDB=clicnat_dev DROPDB=1

Pour savoir si vous avez les droits d'administrateur sur votre base tentez de vous y connecter
    
    psql postgres

l'invite de la console psql doit se terminer par un #

    postgres=# 

Si ce n'est pas le cas pour que votre utilisateur puisse devenir administrateur sur votre serveur postgres :

    sudo su postgres
    createrole votrelogin

N'oubliez pas dire que vous êtes administrateur en répondant oui à la première question. Ensuite éditez le fichier pg\_hba.conf et ajoutez y cette ligne en adaptant "clicnat\_dev" et "votrelogin".

    local   clicnat_dev             votrelogin                         peer
