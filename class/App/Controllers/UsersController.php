<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Users;
use App\Models\UsersManager;

class UsersController extends Controller
{

    public function addusers()
    {
        //on instancie la classe Users pour créer un nouvel utilisateur
        $users = new Users();
        //on anticipe d'éventuelles erreur
        $errors = [];
        if (isset($_POST['submit'])) {
            //si le formulaire est validé on "hydrat" les données dans l'objet
            //avec les données du formulaire
            $users->setUsername($_POST['username']);
            $users->setRealName($_POST['realName']);
            $users->setEmail($_POST['email']);
            $users->setPassword($_POST['password']);
            //si la methode validate ne retourne pas d'erreur on fait l'insert dans la base de données
            $errors = ($users->validate());
            var_dump($_POST);
            if (empty($errors)) {
                //on transforme l'objet Users en tableau
                //avec uniquement les valeurs des propriétés
                // Voir la methode toArray() dans User.php
                $userArray = $users->toArray();
                // On instancie un UserManager
                $usersManager = new UsersManager();
                // On effectue l'insert dans la table
                $insert = $usersManager->insert($userArray);
                // On est très content !

                echo "<p>C'est parfait ! On a inséré l'utilisateur !</p>";
                echo "<p>Son id est {$insert->lastInsertId()}</p>";
                die();
            }
        }
        $templatePath = './views/template_addusers.phtml';
        $this->render($templatePath, [
            '$_POST' => $_POST,
            'users' => $users,
            'error' => $errors
        ]);
    }

    
}
