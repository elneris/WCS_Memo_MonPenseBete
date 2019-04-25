# MeMo Elneris MVC

## Description

Ce repo est une ressource en vue des prochains Checkpoint.

## Etape à pas oublier

1. Initialiser un projet Git init et si il n'y a pas de fichier json composer init.
2. Run `composer install`. Sinon
3. Définir un fichier de connexion à la bdd.
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
4. Toujours lancer le lancer avec -t public
5. Configuration de l'autoloader (PSR4 Namespace Path .... voir fichier json)
6. url = nom du controller / nom method
7. generaliser un max ( exemple security + upload )