<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\ArticlesManager;
use App\Models\UsersManager;


class AdminController extends Controller
{
    public function index()
    {
        $articles = new ArticlesManager();
        $data = $articles->getAll();
        $templatePath = './views/template_adminlist.phtml';
        $this->render($templatePath, $data);
    }


    public function deleteArticle()
    {
        $articleId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($articleId) {
            $articlesManager = new ArticlesManager();

            $success = $articlesManager->delete($articleId);
        } else {
            echo "Article ID is missing.";
        }
    }

    // public function adminupdateArticle()
    // {
    //     $articleId = intval(isset($_GET['id'])) ? $_GET['id'] : null;
    
    //     if ($articleId) {
    //         $article = new ArticlesManager();
    //         $data = $article->getArticleById($articleId);
    //         $templatePath = './views/template_adminupdate.phtml';
    //         $this->render($templatePath, $data);
    //     }
    // }

}
