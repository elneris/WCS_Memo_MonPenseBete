<?php
/**
 * Router
 *
 */

// On recupere l'url et on l'explose en tableau, délimiter par le slash
// le ltrim supprime ensuite le premier slash de REQUEST_URI
// Si on a aucune valeur, on prend HOME_PAGE par defaut

$routeParts = explode('/', ltrim($_SERVER['REQUEST_URI'], '/') ?: HOME_PAGE);

// on définie le chemin de notre controller grace à l'url
// on vient de decouper notre url dans un tableau indexé
// 0 correspond donc au nom du controller mais sans Controller
// on lui rajoute donc Controller a la fin et on met la 1ere lettre en Majuscule ( ucfirst )
// attention donc a bien nommer ces controllers

$controller = 'App\Controller\\' . ucfirst($routeParts[0] ?? '') . 'Controller';

// on fait pareil pour la method qui cette fois est stocker dans le tableau d'index 1

$method = $routeParts[1] ?? '';

// pour les variables on decoupe les 2 premiers index du tableau et on recupere la variable

$vars = array_slice($routeParts, 2);

// on vérifier maintenant sir le controller et la methode existe sinon on redirige vers un controller dedier aux erreur

if (class_exists($controller) && method_exists(new $controller(), $method)) {
    echo call_user_func_array([new $controller(), $method], $vars);

    // le call_user_func_array va appeller la method
} else {
    header('location: /Error/pageNotFound');
    exit;
}
