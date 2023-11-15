<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Users;
use App\Models\UsersManager;

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
            $users->setUsername(strip_tags($_POST['username']));
            $users->setPassword(strip_tags($_POST['password']));
            $users->setEmail(strip_tags($_POST['email']));
            $users->setRealName(strip_tags($_POST['realName']));
            //si la methode validate ne retourne pas d'erreur on fait l'insert dans la base de données
            $errors = ($users->validate());
            if (empty($errors)) {
                //on transforme l'objet Users en tableau
                //avec uniquement les valeurs des propriétés
                //voir la methode toArray()
                $userArray = $users->toArray();
                //on instancie la classe UsersManager
                $usersManager = new UsersManager();
                //on insert l'utilisateur dans la base de données
                $insert = $usersManager->insert($userArray);
                print_r($insert->lastInsertId());
            }

            print_r($userArray);
        }

        $templatePath = './views/template_users.phtml';
        $this->render($templatePath, [
            '$_POST' => $_POST,
            'users' => $users,
            'error' => $errors
        ]);
    }
}
