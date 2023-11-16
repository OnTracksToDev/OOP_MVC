<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Articles;
use App\Models\ArticlesManager;

class ArticlesController extends Controller
{
    public function addArticle()
    {
        $articles = new Articles();
        $errors = [];

        if (isset($_POST['submit'])) {
            $articles->setTitle($_POST['title']);
            $articles->setContent($_POST['content']);
            $articles->setImagePath($_POST['imagePath']);
            $articles->setAuthorID($_POST['authorID']);
            $errors = $articles->validate();

            if (empty($errors)) {
                $articlesArray = $articles->toArray();
                $articlesManager = new ArticlesManager();
                $insert = $articlesManager->insert($articlesArray);

                echo "<p>C'est parfait ! On a inséré l'article !</p>";
                echo "<p>Son id est {$insert->lastInsertId()}</p>";
                die();
            }
        }

        $templatePath = './views/template_addarticles.phtml';
        $this->render($templatePath, [
            '$_POST' => $_POST,
            'articles' => $articles,
            'error' => $errors
        ]);
    }

    public function viewGallery()
    {
        $articlesManager = new ArticlesManager();
        $data = $articlesManager->getAll();
        $templatePath = './views/template_gallery.phtml';
        $this->render($templatePath , $data);
    }


    
}
