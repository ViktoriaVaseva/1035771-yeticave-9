<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">
    <main>
        <nav class="nav">
            <ul class="nav__list container">
                <li class="nav__item">
                    <a href="all-lots.html">Доски и лыжи</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Крепления</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Ботинки</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Одежда</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Инструменты</a>
                </li>
                <li class="nav__item">
                    <a href="all-lots.html">Разное</a>
                </li>
            </ul>
        </nav>
        <form class="form container <?=isset($errors)? 'form--invalid':'';?>" action="login.php" method="post"> <!-- form--invalid -->
            <h2>Вход</h2>
            <div class="form__item <?=isset($errors['email'])? 'form__item--invalid':'';?>"> <!-- form__item--invalid -->
                <label for="email">E-mail <sup>*</sup></label>
                <input id="email" type="text" name="email" placeholder="Введите e-mail">
                <?php if (isset($errors['email'])) : ?>
                <span class="form__error">Введите e-mail</span>
                <?php endif; ?>
            </div>
            <div class="form__item <?=isset($errors['password'])? 'form__item--invalid':'';?> form__item--last">
                <label for="password">Пароль <sup>*</sup></label>
                <input id="password" type="password" name="password" placeholder="Введите пароль">
                <?php if (isset($errors['password'])) : ?>
                <span class="form__error">Введите пароль</span>
                <?php endif; ?>
            </div>
            <button type="submit" class="button">Войти</button>
        </form>
    </main>
</div>


</body>
</html>
