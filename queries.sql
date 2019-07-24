USE yeticave;
INSERT INTO users (email, password, registration_date, user_name, lot_id, price_id)
VALUES ('vika@gmail.com','123456', '2019-06-01', 'Виктория', '3', '1'),
       ('dima@gmail.com','123456', '2019-06-01', 'Дмитрий', '5', '2');

INSERT INTO categories (title, symbol)
VALUES ('Доски и лыжи','boards'),
       ('Крепления','attachment'),
       ('Ботинки','boots'),
       ('Одежда','clothing'),
       ('Инструменты','tools'),
       ('Разное','other');

INSERT INTO lots (dt_add, article, url_picture, start_price, user_author, category_id)
VALUES ('2019-06-07', '2014 Rossignol District Snowboard', 'img/lot-1.jpg', '10999', '1', '1'),
       ('2019-06-08', 'DC Ply Mens 2016/2017 Snowboard', 'img/lot-2.jpg', '159999', '1', '1'),
       ('2019-06-09', 'Крепления Union Contact Pro 2015 года размер L/XL', 'img/lot-3.jpg', '800', '1', '2'),
       ('2019-06-10', 'Ботинки для сноуборда DC Mutiny Charocal', 'img/lot-4.jpg', '10999', '1', '3'),
       ('2019-06-11', 'Куртка для сноуборда DC Mutiny Charocal', 'img/lot-5.jpg', '7500', '2', '4'),
       ('2019-06-12', 'Маска Oakley Canopy', 'img/lot-6.jpg', '5400', '1', '6');

INSERT INTO prices (price, dt_addition, user_id, lot_id)
VALUES ('6000', '2019-06-11', '1', '6'),
       ('8000', '2019-06-12', '1', '5'),
       ('6500', '2019-06-12', '2', '6');

//получить все категории//
SELECT * FROM categories;
//получить самые новые, открытые лоты.//
//Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории.//
SELECT article, url_picture, start_price, title, dt_add, step FROM lots AS t1 JOIN categories AS t3
ON t1.category_id=t3.id ORDER BY dt_add ASC;
//показать лот по его id. Получите также название категории, к которой принадлежит лот//
SELECT article, title FROM lots l JOIN categories c ON l.category_id = c.id WHERE l.id=3;
//обновить название лота по его идентификатору//
UPDATE lots SET article = '2019 Rossignol District Snowboard' WHERE id = 1;
//получить список самых свежих ставок для лота по его идентификатору//
SELECT price FROM prices WHERE lot_id = 6;