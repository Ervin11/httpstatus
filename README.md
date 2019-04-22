# Projet HTTP Status

Site web codé avec Symfony, qui stocke les noms, URL et code HTTP après test, de sites existants dans une base de données Doctrine et les affiche grâce à des templates Twig.

Il permet d'afficher tous les sites ou une seule par ID ainsi que créer, mettre à jour l'URL et supprimer des sites.

Cloner le projet, se rendre dans le dossier du projet avec un terminal et télécharger les dépendances : **composer install**

Editer le fichier .env pour recréer la BDD selon vos identifiants et le port d'accès à MySQL.  

DATABASE_URL=mysql://root:root@127.0.0.1:8889/salif_bourg

Puis : 

- php bin/console doctrine:database:create
- php bin/console make:migration
- php bin/console doctrine:migrations:migrate

Si il y a une erreur avec la dernière commande, c'est normal car les tables existent déjà dans Migrations mais il faut quand même lancer la commande pour qu'elles existent vraiment dans PhpMyAdmin.

