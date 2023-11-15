<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\ArticlesManager;


class HomeController extends Controller
{

    public function index() {
        $articles = new ArticlesManager();
        $data = $articles->getAll();
        $templatePath = './views/template_home.phtml'; 
        $this->render($data, $templatePath);
    }
    

   
}
