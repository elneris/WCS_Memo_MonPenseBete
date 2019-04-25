
## Architecture

- architecture MVC (Modèle Vue Contrôleur)

## Arborescence d'un projet

    my_project/
        config/             <= vos fichiers de config
            config.php
            db.php
        data/               <= vos fichiers de données
            *.sql
        public/             <= document root
            css/            <= vos feuilles de style
                *.css
            fonts/          <= vos typos
            img/            <= vos images
                *.gif
                *.jpg
                *.png
            js/             <= vos fichiers JavaScript
                *.js
            .htaccess       <= config pour apache
            index.php       <= le point d'entrée de votre application
        src/                <= vos fichiers PHP
            Controller/     <= vos controller
            Model/          <= vos modeles
            View/           <= vos templates
                partials/
                    *.twig
                *.twig
        var/
            cache/          <= stockage du cache
            logs/           <= stockage des logs
        vendor/             <= paquets gérés par composer
        .gitignore          <= liste des fichiers que git doit ignorer
        composer.json       <= liste des paquets gérés par composer
        composer.lock       <= liste des paquets gérés par composer
        README.md           <= documentation du projet
