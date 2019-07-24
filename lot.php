<?php
require_once ('function.php');
require_once ('helpers.php');
session_start();

$con = mysqli_connect("yeticave", "root", "","yeticave");
mysqli_set_charset($con, "utf8");

$categories = 'SELECT * FROM categories';
$sql_categories = mysqli_query ($con, $categories);
$list_categories = mysqli_fetch_all($sql_categories, MYSQLI_ASSOC);

if (isset($_GET['lots'])) {
    $lot = $_GET['lots'];

    $select_lot = "SELECT l.id, description, title, article, start_price, deadline, url_picture, step
                FROM lots l JOIN categories c ON l.category_id = c.id WHERE l.id = '$lot'";
    $show_lot = db_fetch_data($con, $select_lot, []);

    $select_price = "SELECT p.id, price, dt_addition, user_id, p.lot_id, user_name, l.id
            FROM prices p JOIN users u ON p.lot_id = u.lot_id JOIN lots l ON l.id = '$lot'";
    $sql_price = mysqli_query($con, $select_price);
    $list_prices = mysqli_fetch_all($sql_price, MYSQLI_ASSOC);

    $is_lot = 0;
    foreach ($show_lot as $val) {
        if ($val['id'] == $_GET['lots']) {
            $is_lot = 1;
        }
    }
    if (!$is_lot) {
        http_response_code(404);
        header("Location: 404.php");
        exit();
    }
}

    if (isset($_SESSION['user'])) {

        $users_id = $_SESSION['user']['id'];
        $user_name = $_SESSION['user']['user_name'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            if (empty($_POST['cost'])) {
                $errors['cost'] = 'Поле пустое';
            }

            $sum = null;
            if (isset($_POST['cost'])) {
                if ($_POST['cost'] < 1000) {
                    $errors['cost'] = 'Цена должна быть больше';
                } else {
                    $sum = $_POST['cost'];
                }
            }

            if (count($errors)) {

                $page_content = include_template('lot_show.php', ['elements' => $show_lot, 'errors' => $errors, 'prices' => $list_prices]);

            } else {

                $sql = "INSERT INTO prices (dt_addition, price, user_id, lot_id) VALUES (NOW(), ?, ?, 1)";
                $insert = db_insert_data($con, $sql, [$sum, $users_id]);

                header("Location: lot.php");

            }
        }
    }

$page_content = include_template('lot_show.php', ['elements'=> $show_lot, 'errors' => $errors, 'prices'=>$list_prices]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'categories' => $list_categories, 'user_author' => $user_name]);
print ($layout_content);