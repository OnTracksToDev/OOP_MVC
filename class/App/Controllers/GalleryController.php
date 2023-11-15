<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Articles;


class GalleryController extends Controller{

    public function index() {
        $articles = new Articles();
        $data = $articles->getAll();
        $templatePath = './views/template_gallery.phtml'; 
        $this->render($data, $templatePath);
    }


}