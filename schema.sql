CREATE DATABASE yeticave;
USE yeticave;

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(128) NOT NULL UNIQUE,
registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
user_name VARCHAR(128) NOT NULL,
password VARCHAR(128) NOT NULL,
avatar VARCHAR(500),
information VARCHAR(128),
lot_id INT,
price_id INT
);

CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(128) NOT NULL,
symbol VARCHAR(128) NOT NULL
);

CREATE TABLE lots (
id INT AUTO_INCREMENT PRIMARY KEY,
dt_add DATETIME DEFAULT CURRENT_TIMESTAMP,
article VARCHAR(128) NOT NULL,
description VARCHAR(500),
url_picture VARCHAR(500),
start_price INT NOT NULL,
deadline DATE,
step INT,
user_author INT,
user_winner INT,
category_id INT
);

CREATE TABLE prices (
id INT AUTO_INCREMENT PRIMARY KEY,
price INT NOT NULL,
dt_addition DATETIME DEFAULT CURRENT_TIMESTAMP,
user_id INT,
lot_id INT
);
