        <section class="promo">
            <h2 class="promo__title">Нужен стафф для катки?</h2>
            <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
            <ul class="promo__list">
                <?php foreach ($categories as $category) : ?> <!--заполните этот список из массива категорий-->
                    <li class="promo__item promo__item--<?=$category['symbol'];?>">
                        <a class="promo__link" href="pages/all-lots.html"><?=htmlspecialchars($category['title']);?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section class="lots">
            <div class="lots__header">
                <h2>Открытые лоты</h2>
            </div>
            <ul class="lots__list">

                <?php foreach ($elements as $element) : ?>
                    <!--заполните этот список из массива с товарами-->
                    <li class="lots__item lot">
                        <div class="lot__image">
                            <img src="<?=($element['url_picture']);?>" width="350" height="260" alt="">
                        </div>
                        <div class="lot__info">
                            <span class="lot__category"><?=$element['category'];?></span>
                            <h3 class="lot__title"><a class="text-link" href="lot.php?lots=<?=$element['id'];?>"><?=htmlspecialchars($element['article']);?></a></h3>
                            <div class="lot__state">
                                <div class="lot__rate">
                                    <span class="lot__amount">Стартовая цена</span>
                                    <span class="lot__cost"><?=htmlspecialchars(give_new_price($element['start_price']));?></span>
                                </div>
                                <div class="lot__timer timer <?=rest_time($element['deadline']) < 1 ? 'timer--finishing' : '';?>">
                                    <?=rest_time($element['deadline']);?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
            
        </section>
