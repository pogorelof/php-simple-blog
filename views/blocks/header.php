<header>
    <h1>Блог</h1>
    <div class="buttons">
        <a class="button" href="/">Главная</a>
        <?php if (isset($_SESSION['user'])) : ?>
            <a class="button" href="/views/profile.php">Аккаунт</a>
            <?php if ($_SESSION['user']['role'] === 'ADMIN') : ?>
                <a class="button button-type-admin" href="/admin">Админ-панель</a>
            <?php endif ?>
            <!-- <a class="button button-type-admin" href="/#">Написать</a> -->
            <button class='button button-type-admin write-open'>Написать</button>
            <a class="button button-type-exit" href="/controllers/UserController.php?action=logout">Выйти</a>
        <?php else : ?>
            <a class="button" href="/views/login.php">Логин</a>
            <a class="button" href="/views/register.php">Регистрация</a>
        <?php endif ?>
    </div>
</header>

<div class='write-form add-form'>
    <form action="/controllers/ArticleController.php?action=publish" method="post">
        <p>
            <label for="title" style='font-size: 23px;'>Заголовок</label>
        </p>
        <p>
            <input class='title-input' type="text" name='title'>
        </p>
        <p>
            <label for="text" style='font-size: 21px;'>Текст</label>
        </p>
        <p>
            <textarea class='text-input' name="text"></textarea>
        </p>
        <p>
            <button type="submit" class="button write-button">Выложить</button>
        </p>
    </form>
</div>

<script>
    const button = document.querySelector('.write-open');
    const form = document.querySelector('.add-form');

    button.addEventListener('click', () => {
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    });
</script>