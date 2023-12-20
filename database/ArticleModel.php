<?php
require_once 'TSingleton.php';
class ArticleModel{
    use TSingleton;

    public static function addArticle($title, $text, $author_id){
        $stmt = self::connect()->prepare("INSERT INTO article(title, text, author_id) VALUES (?,?,?)");
        $stmt->bind_param('ssi', $title, $text, $author_id);
        $stmt->execute();
    }

    public static function showAllArticles(){
        $stmt = self::connect()->prepare("SELECT * FROM article ORDER BY date DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $articles = [];

        foreach($result as $row){
            $articles[] = $row;
        }

        return $articles;
    }

    public static function findArticleById($id){
        $stmt = self::connect()->prepare("SELECT * FROM article WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function findArticlesByAuthorId($author_id){
        $stmt = self::connect()->prepare("SELECT * FROM article WHERE author_id=? ORDER BY date DESC");
        $stmt->bind_param('i', $author_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $articles = [];

        foreach($result as $row){
            $articles[] = $row;
        }

        return $articles;
    }

    public static function deleteArticle($id){
        $stmt = self::connect()->prepare("DELETE FROM article WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public static function editAll($id, $title, $text){
        $stmt = self::connect()->prepare("UPDATE article SET title = ?, text = ? WHERE id=?");
        $stmt->bind_param('ssi', $title, $text, $id);
        $stmt->execute();
    }

    public static function editTitle($id, $title){
        $stmt = self::connect()->prepare("UPDATE article SET title=? WHERE id=?");
        $stmt->bind_param('si', $title, $id);
        $stmt->execute();
    }

    public static function editText($id, $text){
        $stmt = self::connect()->prepare("UPDATE article SET text=? WHERE id=?");
        $stmt->bind_param('si', $text, $id);
        $stmt->execute();
    }
}