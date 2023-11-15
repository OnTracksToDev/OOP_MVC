<?php

namespace App\Models;

use App\Services\Database;


class UsersManager
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($data = [])
    {
        $addUser = $this->db->query("INSERT INTO users (username, password, email, realName) VALUES (:username, :password, :email, :realName),$data");
        return $addUser;
    }
}
