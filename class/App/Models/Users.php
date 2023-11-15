<?php

namespace App\Models;

use App\Models\Table;

class Users extends Table
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
}
