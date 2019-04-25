# PHP Bases

## Notions

- variables (types de données simples, tableaux, objets)
- constantes
- conditions (blocs de type `if`, `else`, `else if` et `switch`)
- boucles (blocs de type `foreach`, `while`, `do while` et `for`)
- fonctions / methode
- classes
- interfaces

## Types de données

- chaîne de caractères (string)
- nombre entier (integer)
- nombre à virgule flottant (float)
- booléen (boolean)
- null
- tableau (array)
- objet (object)

## Valeurs vides

Toutes ces valeurs renvoient `true` si on les utilise avec la fonction `empty()` :

- `0` : zéro (nombre entier)
- `.0` : zéro (nombre à virgule flottante)
- `false`
- `''` ou `""` : une chaîne de caractères vide
- `'0'` ou `"0"` : une chaîne de caractères avec un zéro
- `[]` ou `array()` : un tableau vide
- `null` : la valeur nulle

## Opérateurs

- `=` : affectation
- `==` : égalité
- `>` : plus grand que
- `<` : plus petit que
- `>=` : plus grand ou égal à
- `<=` : plus petit ou égal à
- `!=` : différent de
- `===` : identité (type de données identique et valeur identique)
- `!==` : non identité (type de données différent ou valeur différente)
- `&&` : « et » logique
- `||` : « ou » logique

## Fonctions

Une fonction doit d'abord être définie.
Elle peut prendre un paramètre, plusieurs paramètres ou aucun paramètre.
Elle peut renvoyer une valeur ou ne n'en renvoyer aucune.

Quand une fonction a été définie, on peut l'appeler (c-à-d l'utiliser).

Exemple de définition d'une fonction qui prend deux paramètres et renvoit une valeur :

    function foo($a, $b)
    {
        return $a + $b;
    }

Exemple d'appel :

    // appel de la fonction foo() et affectation de la valeur retournée à la variable $result
    $result = foo(42, 123);

## Programmation orientée objet (POO)

Une classe est la définition d'un objet.

Un objet est une instance de classe.

En POO :

- une variable se nomme « attribut »
- une fonction se nomme « méthode »

### La portée des variables (le scope, en anglais)

Dans une classe, un attribut (une variable) doit toujours être `private`.
Il y a une exception : si la variable doit être accessible depuis une classe enfant, il faut qu'elle soit `protected`.

Les méthodes peuvent être `public`, `protected` ou `private` selon les cas d'usage.
En cas de doute, partez du principe qu'elles sont `public`.

### Les `getters` et les `setters`

Dans une classe les méthodes (fonctions) qui permettent de lire un attribut s'appelent des `getters`.

Les méthodes qui permettent de changer la valeur d'un attribut s'appelent des `setters`.

## Syntaxe

### Bloc PHP

Ne pas fermer le bloc PHP avec `?>` si la page ne contient que du code PHP.

`<?=` et `<?php echo ` sont équivalent

### Signe égal

`=` est impératif (c'est un ordre).
Ce symbol sert à affecter (attribuer) une valeur à une variable.

`==` est interrogatif (c'est une question).
Ce symbol sert à vérifier l'égalité entre deux valeurs.
La plupart du temps, on le trouve dans des blocs de type `if`.

`===` est interrogatif aussi.
Ce symbol sert à vérifier que deux valeurs sont égales et que leur type de données est aussi identique.
La plupart du temps, on le trouve aussi dans des blocs de type `if`.

### Inclusion

L'instruction `require()` permet d'insérer le code provenant d'un autre fichier dans le fichier courant.
On peut imaginer que PHP fait un copier-coller à notre place.

Les instructions `require()` et `include()` font la même chose (un copier-coller dynamique de fichier) mais `require()` a l'avantage de stopper le programme si le fichier n'est pas trouvé.

### Tableaux

`[]` est la notation actuelle (recommandée) qui permet de créer un tableau.
`array()` est l'ancienne notation qui permet de créer un tableau.

Exemple :

    // notation actuelle
    $bar = [];
    $bar2 = [42, 'azerty', 3.14, true];

    // ancienne notation
    $foo = array();
    $foo2 = array(42, 'azerty', 3.14, true);


### Opérateur ternaire

L'opérateur ternaire permet d'exécuter une séquence du type « Si oui, renvoyer ceci, sinon renvoyer cela ».
Cette séquence peut être écrite avec un bloc `if` et `else` mais l'opérateur ternaire peut être utilisé sur une seule ligne, ce qui est pratique.

Exemple avec un bloc `if` :

    if ($erreur) {
        $message = 'il y a une erreur';
    } else {
        $message = 'tout va bien';
    }

Même exemple avec l'opérateur ternaire :

    $message = $erreur ? 'il y a une erreur' : 'tout va bien';

L'opérateur permet aussi une simplification du type « S'il y a une valeur la renvoyer, sinon renvoyer autre chose ».

    $erreur = 'il y a une erreur';
    $message = $erreur ?: 'tout va bien';

## `isset()` VS `!empty()`

`isset()` veut dire « est défini » en anglais; sert à vérifier que l'utilisateur a envoyé des données.

`!empty()` veut dire « non vide » en anglais; sert à vérifier qu'un champ obligatoire a été renseigné.

## Sécurité

Les fonctions `filter_var()` et `filter_input()` permettent de valider ou de filtrer une donnée en provenance de l'utilisateur.

Exemple de validation d'un email :

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        // email valide
    } else {
        // email non valide
    }

ou équivalent :

    if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        // email valide
    } else {
        // email non valide
    }

Exemple de filtrage d'un champ texte :

    $comment = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);

ou équivalent :

    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);