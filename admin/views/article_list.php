<?php require_once 'blocks/admin_check.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>
    <title>Админ-панель</title>
</head>

<body>
    <?php require_once 'blocks/header.php' ?>

    <div class='items'>
        <button><a href="/admin/">Назад</a></button>
        <h2>Статьи</h2>
        <hr>

        <form action="/controllers/ArticleController.php?action=delete-several" method='POST'>
            <?php
            require_once '../../database/ArticleModel.php';
            $articles = ArticleModel::showAllArticles();
            require_once '../../database/UserModel.php';
            $users = UserModel::showAllUsersIdKey();
            ?>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Название</th>
                        <th>Автор</th>
                        <th>Дата</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <?php foreach ($articles as $article) : ?>
                    <tr>
                        <td>
                            <input type="checkbox" name=<?= $article['id'] ?>>
                        </td>
                        <td>
                            <label for=<?= $article['id'] ?>><?= $article['title'] ?></label>
                        </td>
                        <td>
                            <?php $username = $users[$article['author_id']]['login'] ?>
                            <label for=<?= $article['id'] ?>><a href="user_list.php?search=<?= $username ?>"><?= $username ?></a></label>
                        </td>
                        <td>

                            <label for=<?= $article['id'] ?>><?= $article['date'] ?></label>
                        </td>
                        <td>
                            <!-- Редактор заголовка -->
                            <button class='title-edit-button' value=<?= $article['id'] ?>>Редактировать заголовок</button>
                            <div style='display: none;' class='title-edit-<?= $article['id'] ?>'>
                                <form action=""></form>
                                <form action="/controllers/ArticleController.php?action=title-edit&id=<?= $article['id'] ?>" method='post'>
                                    <div class='title-form'>
                                        <textarea name='title'><?= $article['title'] ?></textarea>
                                        <button type="submit">Изменить</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Редактор текста -->
                            <button class='text-edit-button' value=<?= $article['id'] ?>>Редактировать текст</button>
                            <div style='display: none;' class='text-edit-<?= $article['id'] ?>'>
                                <form action=""></form>
                                <form action="/controllers/ArticleController.php?action=text-edit&id=<?= $article['id'] ?>" method='post'>
                                    <div class='text-form'>
                                        <textarea name='text'><?= $article['text'] ?></textarea>
                                        <button type="submit">Изменить</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Кнопка удаления -->
                            <button><a href="/controllers/ArticleController.php?action=delete&id=<?= $article['id'] ?>">Удалить</a></button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <hr>
            <button type='submit'>Удалить отмеченные</button>
        </form>
    </div>

    <script src='/admin/views/js/article_list.js'></script>
</body>

</html>