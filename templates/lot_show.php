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
        <section class="lot-item container">
            <?php foreach ($elements as $element): ?>
            <h2><?php if ($_GET['lots'] == $element['id']): ?><?= $element['article'] ;?><?php endif ?></h2>
            <div class="lot-item__content">
                <div class="lot-item__left">
                    <div class="lot-item__image">
                        <img src="<?= $element['url_picture'] ;?>" width="730" height="548" alt="Сноуборд">
                    </div>
                    <p class="lot-item__category">Категория: <span><?=$element['title'];?></span></p>
                    <p class="lot-item__description"><?= $element['description'] ;?></p>
                </div>
                <div class="lot-item__right">
                    <div class="lot-item__state">
                        <div class="lot-item__timer timer <?=(rest_time($element['deadline'])) < 1 ? 'timer--finishing' : '';?>">
                            <?=rest_time($element['deadline']);?>
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost"><?= give_new_price($element['start_price']) ;?></span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span><?= give_new_price($element['step']) ;?></span>
                            </div>
                        </div>

                        <?php if (isset($_SESSION["user"])) : ?>
                        <form class="lot-item__form" action="lot.php" method="post" autocomplete="off">
                            <p class="lot-item__form-item form__item form__item--invalid">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="text" name="cost" placeholder="1 000">
                                <?php if (isset($errors['cost'])):?>
                                <span class="form__error">Введите корректную цену</span>
                                <?php endif;?>
                            </p>
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                        <?php endif;?>
                    </div>

                    <div class="history">
                        <h3>История ставок (<span><?=count($prices); ?></span>)</h3>
                        <?php foreach ($prices as $price): ?>
                        <table class="history__list">
                            <tr class="history__item">
                                <td class="history__name"><?=$price['user_name'];?></td>
                                <td class="history__price"><?=$price['price'];?></td>
                                <td class="history__time"><?=$price['dt_addition'];?></td>
                            </tr>
                        </table>
                        <?php endforeach;?>
                        <?php endforeach;?>
                    </div>
                </div>

            </div>
        </section>
    </main>
</div>
</body>
