<?php

namespace App\Models;

use App\Models\AbstractTable;
use DateTime;

class Articles extends AbstractTable{

    private ?string $title = null;
    private ?string $content = null;
    private ?string $imagePath = null;
    private ?string $authorID = null;
    private ?DateTime $publicationDate = null;
    

    public function setTitle(string $title){
        $this->title = $title;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setContent(string $content){
        $this->content = $content;
    }
    public function getContent(){
        return $this->content;
    }
    public function setImagePath(string $imagePath){
        $this->imagePath = $imagePath;
    }
    public function getImagePath(){
        return $this->imagePath;
    }
    public function setAuthorID(string $authorID){
        $this->authorID = $authorID;
    }
    public function getAuthorID(){
        return $this->authorID;
    }
    public function getPublicationDate():?DateTime{
        return $this->publicationDate;
    }

    public function toArray(){
        $articlesArray = [
           $this->title, 
           $this->content,
           $this->imagePath,
           $this->authorID,
        ];
        return $articlesArray;
    }
    public function validate(): array
    {
        $errors = [];
        /**
         * Pléthore de vérifications
         */
        //verifie que le nom de l'utilisateur est au moins 3 caractères
        if (empty($this->imagePath)) {
            $errors[] = "Veuillez saisir une image";
        }
        //verifie que le nom complet est au moins 3 caractères
        if (empty($this->title) ) {
            $errors[] = "Veuillez saisir un titre";
        }

        //si l'email n'est pas valide
        if (empty($this->content)) {
            $errors[] = "Veuillez saisir un contenu";
        }
        //si le mot de passe est infereieur à 3 caractères
        if (empty($this->authorID) ) {
            $errors[] = "Veuillez saisir un auteur";
        }
        return $errors;
    }




}