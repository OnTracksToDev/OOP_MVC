<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Users;

class UsersController extends Controller
{

    public function index()
    {
        //on instancie la classe Users pour créer un nouvel utilisateur
        $users = new Users();
        //on anticipe d'éventuelles erreur
        $errors = [];
        if (isset($_POST['submit'])) {
            //si le formulaire est validé on "hydrat" les données dans l'objet
            //avec les données du formulaire
            $users->setUsername($_POST['username']);
            $users->setPassword($_POST['password']);
            $users->setEmail($_POST['email']);
            $users->setRealName($_POST['realName']);
            //si la methode validate ne retourne pas d'erreur on fait l'insert dans la base de données
            $errors = ($users->validate());
            if (empty($errors)) {
                echo "c'est gagné!";
                die();
            }
        }
        $templatePath = './views/template_users.phtml';
        $this->render($templatePath, [
            '$_POST' => $_POST,
            'users' => $users,
            'error' => $errors
        ]);
    }
}
