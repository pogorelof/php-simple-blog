<?php
require_once '../database/ArticleModel.php';

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
}