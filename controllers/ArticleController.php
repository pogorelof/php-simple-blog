<?php
require_once '../database/ArticleModel.php';
session_start();

class ArticleController
{
    public static function delete($id)
    {
        ArticleModel::deleteArticle($id);
    }

    public static function deleteSeveral()
    {
        foreach ($_POST as $id => $v) {
            self::delete($id);
        }
    }

    public static function editText($id, $text){
        ArticleModel::editText($id, $text);
    }

    public static function editTitle($id, $title){
        ArticleModel::editTitle($id, $title);
    }

    public static function addArticle($title, $text){
        ArticleModel::addArticle($title, $text, $_SESSION['user']['id']);
    }

    public static function editAll($id, $title, $text){
        ArticleModel::editAll($id, $title, $text);
    }
}

$action = $_GET['action'];

switch ($action) {
    case 'delete':
        $id = $_GET['id'];
        ArticleController::delete($id);
        header("Location:{$_SERVER['HTTP_REFERER']}");
        break;
    case 'delete-several':
        ArticleController::deleteSeveral();
        header("Location:{$_SERVER['HTTP_REFERER']}");
        break;
    case 'text-edit':
        $id = $_GET['id'];
        $text = $_POST['text'];
        ArticleController::editText($id, $text);
        header("Location:{$_SERVER['HTTP_REFERER']}");
        break;
    case 'title-edit':
        $id = $_GET['id'];
        $text = $_POST['title'];
        ArticleController::editTitle($id, $text);
        header("Location:{$_SERVER['HTTP_REFERER']}");
        break;
    case 'publish':
        $title = $_POST['title'];
        $text = $_POST['text'];
        ArticleController::addArticle($title, $text);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        break;
    case 'edit':
        $id = $_POST['id'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        ArticleController::editAll($id, $title, $text);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        break;
}