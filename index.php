<?php
require_once ('function.php');
require_once ('helpers.php');
session_start();

$con = mysqli_connect("yeticave", "root", "","yeticave");
mysqli_set_charset($con, "utf8");

$lots = "SELECT id, article, start_price, url_picture, deadline FROM lots";
$sql_lots = mysqli_query ($con, $lots);
$list_lots = mysqli_fetch_all($sql_lots, MYSQLI_ASSOC);

$categories = 'SELECT * FROM categories';
$sql_categories = mysqli_query ($con, $categories);
$list_categories = mysqli_fetch_all($sql_categories, MYSQLI_ASSOC);

if (isset($_SESSION['user'])) {

    $users_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['user_name'];
}

$page_content = include_template('index.php', ['categories' => $list_categories, 'elements' => $list_lots]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'categories' => $list_categories, 'user_author' => $user_name]);
print ($layout_content);