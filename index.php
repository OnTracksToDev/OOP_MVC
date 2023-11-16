<?php

// Attention on doit préciser au programme l'espace de nom à utiliser
namespace App;

// Je vais chercher le routeur se trouvant dans mon espace de nom dans le "dossier" Service
use App\Services\Router;

require_once("./autoload.php");

// Charge nos classes automatiquement
$router = new Router();
$page = $router->getPage();

// Charge le controller correspondant
$controllerName = 'App\Controllers\\' . strtolower($page) . 'Controller';

// Vérifie si la classe du controller existe
if (class_exists($controllerName)) {
    // Instancie le controller
    $controller = new $controllerName();

    // Minuscule la première lettre du nom du controller
    $method = strtolower($page);

    // Vérifie s'il existe une action dans l'URL avec la méthode correspondante (Router.php)
    $action = $router->getAction();

    // Switch pour différents controllers


    switch ($page) {
        case 'home':
            $controller->index();
            break;

        case 'articles':
            // Appelle la méthode sur le controller ArticlesController en fonction de l'action
            if ($action == 'gallery') {
                $controller->viewGallery();
            } elseif ($action == 'add') {
                $controller->addArticle();
            } else {
                $router->redirectToHome();
            }
            break;

        case 'users':
            if ($action == 'add') {
                // Appelle la méthode sur le controller UsersController
                $controller->addUsers();
            } else {
                $router->redirectToHome();
            }
            break;

            case 'admin':
                if ($action == 'delete') {
                    $controller->deleteArticle();
                } elseif ($action == 'update') {
                    $controller->updateArticle();
                } else {
                    $controller->index();
                }
                break;
            


        default:
            $router->redirectToHome();
            break;
    }
} else {
    echo "classe inconnue";
}
