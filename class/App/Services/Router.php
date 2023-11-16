<?php

namespace App\Services;

/**
 * A very simple class router
 */
class Router
{
    private $page;
    private $action;

    public function __construct()
    {
        $this->setPage();
        $this->setAction();
    }

    public function setPage()
    {
        // Validation du nom de la page 
        $page = isset($_GET['page']) ? strtolower($_GET['page']) : 'home';

        // Validation du fichier du contrôleur
        $controllerFile = "./class/App/Controllers/{$page}Controller.php";
        $this->page = file_exists($controllerFile) ? $page : 'home';
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setAction()
    {
        // Validation de l'action 
        $this->action = isset($_GET['action']) ? strtolower($_GET['action']) : 'index';
    }

    public function getAction()
    {
        return $this->action;
    }

    public function redirectToHome()
    {
        header('Location: index.php?page=home');
        exit();
    }
}
