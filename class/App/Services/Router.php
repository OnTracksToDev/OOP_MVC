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

    
    public function setPage() {
     $this->page = isset($_GET['page']) && file_exists('./class/App/Controllers/'.ucfirst($_GET['page']).'Controller.php') ? strtolower($_GET['page']):'home';
    }

    public function getPage()
    {
        return $this->page;
        return $this->action;
    }
    public function setAction()
    {
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
