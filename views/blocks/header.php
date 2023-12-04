<header>
    <h1>Блог</h1>
    <div class="buttons">
        <a class="button" href="/">Главная</a>
        <?php if (isset($_SESSION['user'])) : ?>
            <a class="button" href="/views/profile.php">Аккаунт</a>
            <?php if ($_SESSION['user']['role'] === 'ADMIN') : ?>
                <a class="button button-type-admin" href="/admin">Админ-панель</a>
            <?php endif ?>
            <a class="button button-type-exit" href="/controllers/UserController.php?action=logout">Выйти</a>
        <?php else : ?>
            <a class="button" href="/views/login.php">Логин</a>
            <a class="button" href="/views/register.php">Регистрация</a>
        <?php endif ?>
    </div>
</header>