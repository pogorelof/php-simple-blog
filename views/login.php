<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>

    <title>Регистрация</title>
</head>

<body>

    <?php require_once 'blocks/header.php' ?>

    <form action="/controllers/UserController.php?action=login" class='auth-form' method='post'>
        <h2>Логин</h2>

        <p>
            <label for="login">Логин:</label>
            <input type="text" name="login" required>
        </p>
        <p>
            <label for="password">Пароль:</label>
            <input type="password" name="password" required>
        </p>
        <button class='button' type='submit'>Войти</button>
    </form>

</body>

</html>