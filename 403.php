<?php
require_once ('function.php');
require_once ('helpers.php');
session_start();

$con = mysqli_connect("yeticave", "root", "","yeticave");
mysqli_set_charset($con, "utf8");

$categories = 'SELECT * FROM categories';
$sql_categories = mysqli_query ($con, $categories);
$list_categories = mysqli_fetch_all($sql_categories, MYSQLI_ASSOC);

if (empty($_SESSION['user'])) {

    $users_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['user_name'];

}
$page_content = include_template('403.php');
$page_layout = include_template('layout.php', ['content' => $page_content, 'categories' => $list_categories, 'user_author' => $user_name]);
print ($page_layout);