<?php

namespace App\Models;

use App\Services\Database;

class ArticlesManager
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll($nb = null)
    {
        $limit = !is_null($nb) ? "LIMIT " . $nb : "";
        $articles = [];
        $articles = $this->db->selectAll("SELECT * FROM articles 
                JOIN users ON articles.authorID = users.userID
                ORDER BY articleID DESC" . $limit);
        return $articles;
    }

    public function getArticleById($id = null)
    {
        $whereId = !is_null($id) ? "WHERE id=?" : "";
        $articles = [];
        $articles = $this->db->select("SELECT * FROM articles 
        JOIN users ON articles.authorID = users.userID" . $whereId . "LIMIT 1", [$id]);
        return $articles;
    }

    public function insert($data = [])
    {
        $addPic = $this->db->query("INSERT INTO articles (title, content, imagePath, authorID) VALUES (?,?,?,?)", $data);
        return $addPic;
    }

    public function delete($id = null)
    {
        if (!is_null($id)) {
            $this->db->query("DELETE FROM articles WHERE id=?", [$id]);
            return true;
        }
        return false;
    }
}
