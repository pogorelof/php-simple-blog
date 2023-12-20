<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>

    <title>Профиль</title>
</head>

<body>

    <?php require_once 'blocks/header.php' ?>
    <?php
    require_once '../database/ArticleModel.php';
    $articles = ArticleModel::findArticlesByAuthorId($_SESSION['user']['id']);
    ?>
    <h1 style='padding-left: 15px;'>Ваши статьи</h1>
    <div class='blog'>

        <?php foreach ($articles as $article) : ?>
            <div class="card profile-card">
                <h3 class='card-title'>
                    <?= $article['title'] ?>
                </h3>
                <p class='card-text'>
                    <?= $article['text'] ?>
                </p>
                <p class='card-date'>
                    Опубликовано: <?= $article['date'] ?>
                </p>
                <hr><br>
                <button class='button edit-button' style='font-size:100%' value=<?= $article['id'] ?>>Редактировать</button>
                <a href="/controllers/ArticleController.php?action=delete&id=<?= $article['id'] ?>" class='button button-type-exit'>Удалить</a>
            </div>
        <?php endforeach ?>
    </div>
    <?php foreach ($articles as $article) : ?>
        <div class='write-form edit-form-<?= $article['id'] ?>' style='display: none; padding:10px;'>
            <form action="/controllers/ArticleController.php?action=edit" method="post">
                <p>
                    <label for="title" style='font-size: 23px;'>Заголовок</label>
                </p>
                <p>
                    <textarea class='title-input' type="text" name='title'> <?= $article['title'] ?> </textarea>
                </p>
                <p>
                    <label for="text" style='font-size: 21px;'>Текст</label>
                </p>
                <p>
                    <textarea class='text-input' name="text"><?= $article['text'] ?></textarea>
                </p>
                <p>
                    <button type="submit" class="button write-button" name='id' value=<?= $article['id'] ?>>Редактировать</button>
                </p>
            </form>
            <button class="button button-type-exit close" value=<?= $article['id'] ?>>Закрыть</button>
        </div>
    <?php endforeach ?>
    <script>
        const buttons = document.querySelectorAll('.edit-button');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.value;
                const form2 = document.querySelector(`.edit-form-${id}`)
                form2.style.display = 'block';

            });
        });

        const closes = document.querySelectorAll('.close')
        closes.forEach(close => {
            close.addEventListener('click', () => {
                const id = close.value;
                const form2 = document.querySelector(`.edit-form-${id}`)
                form2.style.display = 'none'
            })
        })
    </script>

</body>

</html>