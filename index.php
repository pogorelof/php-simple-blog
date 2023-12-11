<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'views/blocks/head.php' ?>
    
    <title>Главная страница</title>
</head>
<body>

<?php require_once 'views/blocks/header.php' ?>

<?php 
require_once 'database/ArticleModel.php';
require_once 'database/UserModel.php';
$articles = ArticleModel::showAllArticles();
$users = UserModel::showAllUsersIdKey();
?>
<div class='blog'>
    <?php foreach($articles as $article): ?>
    <div class='card'>
        <h3 class='card-title'>
            <?= $article['title'] ?>
        </h3>
        <p class='card-text'>
            <?= $article['text'] ?>
        </p>
        <p class='card-date'>
            Автор: <?= $users[$article['author_id']]['login'] ?>
        </p>
        <p class='card-date'>
            Опубликовано: <?= $article['date'] ?>
        </p>
    </div>
    <?php endforeach ?>
</div>

</body>
</html>