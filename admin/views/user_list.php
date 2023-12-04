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
        <h2>Пользователи</h2>
        <form action="" class='search' method="GET">
            <input type="text" name="search">
            <button type='submit'>Найти</button>
            <button type='submit'><a href="/admin/views/list.php">Все</a></button>
        </form>
        <hr>

        <form action="/controllers/UserController.php?action=delete-several" method='POST'>
            <?php
            require_once '../../database/UserModel.php';
            $users = UserModel::showAllUsers();
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                foreach ($users as $user) {
                    if ($user['login'] === $search) {
                        $users = [$user];
                        break;
                    }
                }
            }
            ?>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Имя</th>
                        <th>Роль</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <?php
                        if ($user['login'] === $_SESSION['user']['login']) {
                            continue;
                        }
                        ?>
                        <td>
                            <input type="checkbox" name=<?= $user['id'] ?>>
                        </td>
                        <td>
                            <label for=<?= $user['id'] ?>><?= $user['login'] ?></label>
                        </td>
                        <td>

                            <label for=<?= $user['id'] ?>><?= $user['role'] ?></label>
                        </td>
                        <td>
                            <button class='password-edit-button' value=<?= $user['id'] ?>>Редактировать пароль</button>
                            <div style='display: none;' class='password-edit-<?= $user['id'] ?>'>
                                <form action=""></form>
                                <form action="/controllers/UserController.php?action=password-edit&id=<?= $user['id'] ?>" method='post'>
                                    <input type="password" name='newpass'>
                                    <button type="submit">Изменить</button>
                                </form>
                            </div>

                            <button><a href="/controllers/UserController.php?action=delete&id=<?= $user['id'] ?>">Удалить</a></button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <hr>
            <button type='submit'>Удалить отмеченных</button>
        </form>
    </div>

    <script src='/admin/views/js/user_list.js'></script>

</body>

</html>