<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление лота</title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/flatpickr.min.css" rel="stylesheet">
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
        <form class="form form--add-lot container <?=(isset($errors)) ? "form--invalid" : "";?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
            <h2>Добавление лота</h2>
            <div class="form__container-two">
                <div class="form__item <?=(isset($errors['lot-name'])) ? "form__item--invalid" : "";?> "> <!-- form__item--invalid -->
                    <label for="lot-name">Наименование <sup>*</sup></label>
                    <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота">
                    <?php if (isset($errors['lot-name'])): ?>
                    <span class="form__error">Введите наименование лота</span>
                    <?php endif; ?>
                </div>
                <div class="form__item <?=(isset($errors['category'])) ? "form__item--invalid" : "";?>">
                    <label for="category">Категория <sup>*</sup></label>
                    <select id="category" name="category">
                        <option>Выберите категорию</option>
                        <?php foreach ($categories as $category): ?>
                        <option><?=$category['title'];?></option>
                        <?php endforeach;?>
                    </select>
                    <?php if (isset($errors['category'])): ?>
                    <span class="form__error">Выберите категорию</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form__item <?=(isset($errors['message'])) ? "form__item--invalid" : "";?> form__item--wide">
                <label for="message">Описание <sup>*</sup></label>
                <textarea id="message" name="message" placeholder="Напишите описание лота"></textarea>
                <?php if (isset($errors['message'])): ?>
                <span class="form__error">Напишите описание лота</span>
                <?php endif; ?>
            </div>
            <div class="form__item <?=isset($errors['lot-img']) ? "form__item--invalid" : "" ;?> form__item--file">
                <label>Изображение <sup>*</sup></label>
                <div class="form__input-file">
                    <input class="visually-hidden" type="file" id="lot-img" name="lot-img" value="">
                    <label for="lot-img">
                        Добавить
                    </label>
                    <?php if (isset($errors['lot-img'])): ?>
                        <span class="form__error"><?=$errors['lot-img'];?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form__container-three">
                <div class="form__item <?=isset($errors['lot-rate']) ? "form__item--invalid" : "" ;?> form__item--small">
                    <label for="lot-rate">Начальная цена <sup>*</sup></label>
                    <input id="lot-rate" type="text" name="lot-rate" placeholder="0">
                    <?php if (isset($errors['lot-rate'])): ?>
                    <span class="form__error">Введите начальную цену числом</span>
                    <?php endif;?>
                </div>
                <div class="form__item <?=isset($errors['lot-step']) ? "form__item--invalid" : "";?> form__item--small">
                    <label for="lot-step">Шаг ставки <sup>*</sup></label>
                    <input id="lot-step" type="text" name="lot-step" placeholder="0">
                    <?php if (isset($errors['lot-step'])) : ?>
                    <span class="form__error">Введите шаг ставки числом</span>
                    <?php endif;?>
                </div>
                <div class="form__item  <?=isset($errors['lot-date'])  ? "form__item--invalid" : "";?> ">
                    <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
                    <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
                    <?php if (isset($errors['lot-date'])) : ?>
                    <span class="form__error">Введите дату завершения торгов</span>
                    <?php endif;?>
                </div>
            </div>
            <?php if (isset($errors)): ?>
            <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
            <?php endif; ?>
            <button type="submit" class="button">Добавить лот</button>
        </form>
    </main>
</div>

<script src="../flatpickr.js"></script>
<script src="../script.js"></script>
</body>
</html>
