<?php

namespace App;

use App\Services\Router;

require_once("./autoload.php");

$router = new Router();
$page = $router->getPage();
$controllerName = 'App\Controllers\\' . strtolower($page) . 'Controller';

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    $method = strtolower($router->getAction());

    if (method_exists($controller, $method)) {
        // Appelle la méthode du contrôleur correspondant à l'action
        $controller->$method();
    } else {
        // Redirection vers la page d'accueil si la méthode n'existe pas
        $router->redirectToHome();
    }
} else {
    echo "Classe inconnue";
}
