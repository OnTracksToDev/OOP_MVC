<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\ArticlesManager;


class GalleryController extends Controller{

    public function index() {
        $articles = new ArticlesManager();
        $data = $articles->getAll();
        $templatePath = './views/template_gallery.phtml'; 
        $this->render($data, $templatePath);
    }


}