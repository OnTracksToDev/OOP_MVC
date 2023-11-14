<?php

namespace App\Controllers;

use App\Models\Pictures;


class HomeController
{

    public function index() {
        $images = new Pictures();
        $data = $images->getAll();
        $templatePath = './views/template_home.phtml'; 
        $this->render($data, $templatePath);
    }
    

    public function render($data, $templatePath)
    {
        ob_start();
        include $templatePath;
        $content = ob_get_clean();
        include './views/layout.phtml';
    }
}
