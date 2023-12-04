<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'blocks/head.php' ?>

    <title>Регистрация</title>
</head>

<body>

    <?php require_once 'blocks/header.php' ?>

    <form action="/controllers/UserController.php?action=register" class='auth-form' method='post'>
        <h2>Регистрация</h2>

        <p>
            <label for="login">Логин:</label>
            <input type="text" name="login" required>
        </p>
        <p>
            <label for="password">Пароль:</label>
            <input type="password" name="password" required>
        </p>
        <p>
            <label for="password_repeat">Повторите пароль:</label>
            <input type="password" name="password_repeat" required>
        </p>
        <button class='button' type='submit'>Зарегистрироваться</button>
    </form>

</body>

</html>