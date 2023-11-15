<?php
namespace App\Models;

use App\Services\Database;

class Articles
{
    public static function getAll()
    {
        $articles = [];
        $db = new Database();
        $results = $db->query("SELECT * FROM articles 
                JOIN users ON articles.authorID = users.userID

        ORDER BY articleID DESC");
        foreach ($results as $row) {
            $article = [
                'identifier' => $row['articleID'],
                'title' => $row['title'],
                'content' => $row['content'],
                'imagePath' => $row['imagePath'],
                'publicationDate' => $row['publicationDate'],
                'authorName' => $row['username'],
            ];
            $articles[] = $article;
        }
        return $articles;
    }



    public static function getArticleById($articleID)
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM articles 
        JOIN users ON articles.authorID = users.userID
        WHERE articleID = ? LIMIT 1", [$articleID]);
        if (empty($result)) {
            return null;
        }
        $row = $result[0];
        $article = [
            'identifier' => $row['articleID'],
            'title' => $row['title'],
            'content' => $row['content'],
            'imagePath' => $row['imagePath'],
            'publicationDate' => $row['publicationDate'],
            'authorName' => $row['username'],
        ];
        return $article;
    }




    public static function getLastFourArticles()
    {
        $articles = [];
        $db = new Database();
        $results = $db->query("SELECT * FROM articles 
                JOIN users ON articles.authorID = users.userID

        ORDER BY articleID DESC LIMIT 4");
        foreach ($results as $row) {
            $article = [
                'identifier' => $row['articleID'],
                'title' => $row['title'],
                'content' => $row['content'],
                'imagePath' => $row['imagePath'],
                'publicationDate' => $row['publicationDate'],
                'authorName' => $row['username'],
            ];
            $articles[] = $article;
        }
        return $articles;
    }

    public static function searchBar()
    {
        if (!isset($_GET['query'])) {
            return [];
        }
        $db = new Database();
        $query = strtolower(strval(urldecode(trim($_GET['query']))));
        $results = $db->query("SELECT * FROM articles WHERE title LIKE '%" . $query . "%' OR content LIKE '%" . $query . "%' OR imagePath LIKE '%" . $query . "%' OR authorID LIKE '%" . $query . "%'");
        return $results;
    }

    // public function updateImage($id, $title, $description, $source, $author) {


    //     $pdo = connectDB();
    //     $sql = $pdo->prepare("UPDATE images SET title = ?, description = ?, source = ?, author = ?, updated_at = ? WHERE id = ?");
    //     $sql->execute([
    //         $title,
    //         $description,
    //         $source,
    //         $author,
    //         date('Y-m-d H:i:s'),
    //         $id
    //     ]);

    // }

}
