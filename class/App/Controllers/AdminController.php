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
    public function updateArticle()
    {
        $articleId = intval(isset($_GET['id'])) ? $_GET['id'] : null;

        if ($articleId) {
            $articlesManager = new ArticlesManager();

            $success = $articlesManager->update(
                $articleId,
                $_POST['imagePath'],
                $_POST['title'],
                $_POST['content'],
                $_POST['authorID']
            );

            if ($success) {
                header('Location: index.php?page=admin&action=index');
                exit();
            } else {
                echo "échec MAJ.";
            }
        } else {
            echo "Article ID non trouvé.";
        }
        $templatePath = './views/template_adminupdate.phtml';
        $this->render($templatePath, [
            'articleID' => $articleId,
            'article' => $_POST,
        ]);

    }
}
