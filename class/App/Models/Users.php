<?php

namespace App\Models;

use App\Models\AbstractTable;
use DateTime;

class Users extends AbstractTable
{

    private ?string $username = null;
    private ?string $password = null;
    private ?string $email = null;
    private ?string $realName = null;
    private ?array $roles = [];

    /*Username */
    public function setUsername(?string $username)
    {
        $this->username = $username;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }
    /* Password */
    public function setPassword(?string $password)
    {
        $this->password = $password;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }
    /* Email */
    public function setEmail(?string $email)
    {
        $this->email = $email;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /* Real Name */
    public function setRealName(?string $realName)
    {
        $this->realName = $realName;
    }
    public function getRealName(): ?string
    {
        return $this->realName;
    }
    /* Roles */
    public function setRoles(?array $roles)
    {
        $this->roles = $roles;
    }
    public function getRoles(): ?array
    {
        return $this->roles;
    }
    // public function getCreatedAt(): ?DateTime
    // {
    //     return $this->createdAt;
    // }

    // public function setUpdatedAt(?DateTime $updatedAt)
    // {
    //     $this->updatedAt = $updatedAt;
    // }
    // public function getUpdatedAt(): ?DateTime
    // {
    //     return $this->updatedAt;
    // }
    public function toArray(){
        $userArray = [
            $this->username, 
            $this->email, 
            $this->realName,
            password_hash($this->password, PASSWORD_DEFAULT)];
        return $userArray;
    }
    
    public function validate(): array
    {
        $errors = [];
        /**
         * Pléthore de vérifications
         */
        //verifie que le nom de l'utilisateur est au moins 3 caractères
        if (strlen($this->username) < 3) {
            $errors[] = "Le nom d'utilisateur est obligatoire";
        }
        //verifie que le nom complet est au moins 3 caractères
        if (strlen($this->realName) < 3) {
            $errors[] = "Le nom complet est obligatoire";
        }

        //si l'email n'est pas valide
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Veuillez saisir un email valide s'il vous plaît";
        }
        //si le mot de passe est infereieur à 3 caractères
        if (strlen($this->password) < 3) {
            $errors[] = "Le mot de passe doit être au moins 3 caractères";
        }
        return $errors;
    }
}
