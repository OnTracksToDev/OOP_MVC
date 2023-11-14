<?php

//Attention on doit préciser au programme l'espace de nom à utiliser
namespace App;
//je vais chercher le routeur se trouvant dant mon espace de nom dans le "dossier" Service
use App\Services\Router;


//charge nos class automatiquement
require_once("./autoload.php");


//détermine la route ?page
$router = new Router();
$page = $router->getPage();

//Charge le controller correspondante
$controllerName = 'App\Controllers\\' . ucfirst($page) . 'Controller';

// $controllerPath = './class/Controllers/' . $controllerName . '.php';
// require_once $controllerPath;
$controller = new $controllerName();

$controller->index();
