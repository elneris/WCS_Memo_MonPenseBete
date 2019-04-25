# Twig

Twig est un moteur de « template ». Un « template » est un fichier dans lequel on définit la façon dont des données vont être affichées.

Dans le modèle « MVC », le template correspond au « V », la vue (View en anglais).

## Sans framework (en PHP brut)

### Installation

Pour installer le paquet :

    composer require twig/twig ~2.0

### Exemple Utilisation

Ouvrir le fichier `exemple.php` puis ajouter :

    
   
    // instanciation du chargeur de templates
    $loader = new FilesystemLoader(path exemple  __DIR__ . '/../src/View/');

    // instanciation du moteur de template
    $twig = new Twig_Environment($loader);

    // initialisation d'une donnée
    $exemple = 'Hello Elne';

    // affichage du rendu d'un template
    echo $twig->render('exemple.html.twig', [
        // transmission de données au template
        'exemple' => $exemple,
    ]);


### Tester

Dans le terminal, depuis le dossier racine du projet, lancer un serveur web de développement :

    php -S localhost:8000 -t public


### Configuration

#### Pour la phase de dev

activer :

- le mode debug
- le mode de variables strictes

Le mode debug permet d'utiliser la fonction `dump()` dans un template Twig pour inspecter le contenu d'une variable.

Le mode de variables strictes permet d'afficher une erreur si vous utilisez une variable qui n'a pas été initialisée (c-à-d non transmise au template Twig).

Modifier la partie `new Twig_Environment($loader)` et charger l'extension de debug `Twig_Extension_Debug` juste après :

    // instanciation du moteur de template
    $twig = new Twig_Environment($loader, [
        // activation du mode debug
        'debug' => true,
        // activation du mode de variables strictes
        'strict_variables' => true,
    ]);

    // chargement de l'extension Twig_Extension_Debug
    $twig->addExtension(new Twig_Extension_Debug());

Maintenant il est possible d'inspecter le contenu d'une variable dans un template Twig.

Exemple :

    {{ dump(exemple) }}

#### Pour la prod

Il est recommandé de désactiver la configuration de la phase de dev et d'activer :

- le cache

Le cache permet de stocker le rendu PHP des templates Twig dans un dossier et de le recharger lors de la prochaine demande.
C'est une optimisation qui doit être appliquée quand le code est en production.

Créer le dossier `var/cache` à la racine du projet.

Modifier la partie `new Twig_Environment($loader)` :

    // instanciation du moteur de template
    $twig = new Twig_Environment($loader, [
        // activation du cache
        'cache' => __DIR__.'/../var/cache',
    ]);

NB Pensez à désactiver ou supprimer le chargement de l'extension de debug `Twig_Extension_Debug`.

## Syntaxe de templates Twig

### Notions de base

Il n'y a que trois types de blocs de code Twig :

1. `{# #}` : pour les commentaires
2. `{{ }}` : pour afficher une variable
3. `{% %}` : pour effectuer une action

### Les commentaires

Noter un commentaire :

    {# ceci est un commentaire #}

Le bloc accepte les commentaires multi-lignes.

### Afficher une variable

Pour afficher une variable, il faut utiliser deux paires d'accolades `{{ }}`.

NB Le filtre `escape('html')` (c-à-d `htmlentities()`) est automatiquement appliqué dès qu'une variable est affichée.

Afficher la variable `exemple` :

    {{ exemple }}

Afficher la valeur associée à la clé alpha-numérique `prenom` du tableau `user` :

    {{ user.prenom }}


Afficher la valeur renvoyée par la méthode `index` de la variable de type objet `Home` :

    {{ Home.index() }}

NB La notation est la même pour accéder à une clé d'un tableau ou à un attribut d'un objet, on utilise le point `.`.

### Les structures conditionnelles (blocs `if`)

Le `if` est identique en PHP et en Twig.
La seule différence est qu'il n'y a pas de parenthèses.

Si la variable  `foo` est égal à `true`, afficher la variable `bar` :

    {% if foo %}
        {{ bar }}
    {% endif %}

Si l'attribut `bar` de la variable  `foo` est égal à `true`, afficher la variable `baz`  :

    {% if foo.bar %}
        {{ baz }}
    {% endif %}

Si la clé ou l'attribut `bar` du tableau ou de l'objet `foo` existe, afficher la valeur de `foo.bar` :

    {% if foo.bar is defined %}
        {{ foo.bar }}
    {% endif %}

NB La syntaxe Twig `foo.bar is defined` est équivalente à la syntaxe PHP `isset($foo['bar'])`.

### Les boucles

La syntaxe Twig pour les boucle est différente de PHP.

En PHP, pour parcourir tous les éléments d'un tableau, on utilise `foreach ($items as $item)`.
`$items` désigne le tableau et `$item` un élément différent du tableau à chaque tour.

Avec Twig, pour faire la même chose, on utilise `for item in items`.
`items` désigne le tableau et `$item` un élément différent du tableau à chaque tour.
Sauf que l'ordre est différent : avec Twig on a d'abord l'élément, puis le tableau.
En français, on dirait : « pour chaque item du tableau items ».

Boucler sur le tableau `items` qui contient des chaînes de caractères :

    {% for item in items %}
        {{ item }}<br />
    {% endfor %}

Boucler sur le tableau `items` qui contient des tableaux avec des clé alpha-numériques :

    {% for item in items %}
        {{ item.id }}<br />
        {{ item.name }}<br />
    {% endfor %}

Boucler sur le tableau `items` qui contient des objets :

    {% for item in items %}
        {{ item.id }}<br />
        {{ item.name }}<br />
    {% endfor %}

Boucler sur le tableau `items` qui contient des objets et appeler ses méthodes :

    {% for item in items %}
        {{ item.getId() }}<br />
        {{ item.getName() }}<br />
    {% endfor %}

Récupérer « un à un » les éléments du résultat d'une requête SQL exécutée  :

    {% for item in items %}
        {{ item.id }}<br />
        {{ item.name }}<br />
    {% endfor %}

NB La notation est toujours la même : on utilise `for item in items`.

### L'héritage (ou l'extension) de templates

Avec Twig, il n'est pas nécessaire d'utiliser `include()` pour composer un template à partir de plusieurs morceaux.

L'idée est de créer un template initial sur lequel tous les autres templates seront basés.
Ceci permet de ne pas répéter de code et de pouvoir se passer des `include()` de PHP.

Définir un template parent que les templates enfants pourront étendre :

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>{% block title %}{% endblock %}</title>

            {% block css_head %}
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
            <link rel="stylesheet" href="/css/main.css" />
            {% endblock %}

            {% block js_head %}
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
            <script src="/js/main.js"></script>
            {% endblock %}
        </head>
        <body>
            {% block content %}{% endblock %}

            {% block js_body %}{% endblock %}
        </body>
    </html>

Créer un template enfant qui hérite du template  :

    {% extends 'base.html.twig' %}

    {% block title %}Elneris{% endblock %}

    {% block content %}
        <h1>coucou</h1>
    {% endblock %}

Créer un template enfant qui hérite du template, et qui surcharge  les blocs `css_head` et `js_head` :

    {% extends 'base.html.twig' %}

    {% block title %}hello{% endblock %}

    {# surcharge du bloc css_head #}
    {# intégration de materialize au lieu de bootstrap #}
    {% block css_head %}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" href="/css/main.css" />
    {% endblock %}

    {# surcharge du bloc js_head #}
    {# intégration de materialize au lieu de bootstrap #}
    {% block js_head %}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="/js/main.js"></script>
    {% endblock %}

    {% block content %}
        <h1>Hello</h1>
        <p>Vous êtes sur la page 2</p>
    {% endblock %}

### Les includes

NB Il est rare d'avoir besoin de la fonction `include()` avec Twig.

Comme en PHP, il est possible de faire des includes.
La fonctionnalité `include()` est utile si plusieurs templates enfants utilisent un même bloc de code.
On parle alors de template `partial` (partiel) (ou inc ).

Définir le bloc de code commun dans le fichier `templates/partials/_items.html.twig` :


Utiliser le template `partial` dans le template :

    {% include('partials/_items.html.twig') %}
