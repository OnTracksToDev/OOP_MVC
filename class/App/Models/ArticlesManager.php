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

    public function delete($articleID = null)
    {
        if (!is_null($articleID)) {
            $this->db->query("DELETE FROM articles WHERE articleID=?", [$articleID]);
            return true;
        }
        return false;
    }

    // public function update($articleID, $imagePath, $title, $content, $authorID)
    // {
    //     if (!is_null($articleID)) {
    //         $this->db->query("UPDATE articles SET imagePath=?, title=?, content=?, authorID=? WHERE articleID=?", [$imagePath, $title, $content, $authorID, $articleID]);
    //         return true;
    //     }
    //     return false;
    // }

    public function update($articleId, $imagePath, $title, $content, $authorID)
    {
        if (!is_null($articleId)) {
            $query = "UPDATE articles SET imagePath=?, title=?, content=?, authorID=? WHERE articleID=?";
            $params = [$imagePath, $title, $content, $authorID, $articleId];


            $success = $this->db->query($query, $params);

            return $success;
        }

        return false;
    }
}
