<?php
$con = mysqli_connect("yeticave", "root", "","yeticave");
mysqli_set_charset($con, "utf8");

require_once ('helpers.php');
require_once ('function.php');

$sql = "SELECT * FROM categories";
$list_categories = db_fetch_data($con, $sql, []);
session_start();

if (isset($_SESSION['user'])) {

    $users_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['user_name'];
}

$page_content = include_template('my_bets.php', []);
$layout_content = include_template('layout.php', ['content' => $page_content, 'categories' => $list_categories, 'user_author' => $user_name]);
print ($layout_content);
