<?php
$con = mysqli_connect("yeticave", "root", "","yeticave");
mysqli_set_charset($con, "utf8");

require_once ('helpers.php');
require_once ('function.php');
session_start();

if (isset($_SESSION['user'])) {

    $users_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['user_name'];

    $sql = "SELECT * FROM categories";
    $list_categories = db_fetch_data($con, $sql, []);

    $sql_lot = "SELECT l.id, title, article, dt_add, description, url_picture, start_price, user_author, category_id, step,
            DATE_FORMAT(deadline, '%d.%m.%Y') deadline FROM lots l JOIN categories c ON l.category_id = c.id WHERE user_author = '$user_name'";
    $list_lots = db_fetch_data($con, $sql_lot, []);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $required = ['lot-name', 'message', 'lot-rate', 'lot-step', 'lot-date'];
        $errors = [];
        $lot_rate = intval($_POST['lot-rate']);
        $lot_step = intval($_POST['lot-step']);

        if (!intval($_POST['lot-rate'])) {
            $errors['lot-rate'] = "Ввести цифрами";
        }

        if (!intval($_POST['lot-step'])) {
            $errors['lot-step'] = "Ввести цифрами";
        }

        foreach ($required as $item) {
            if (empty($_POST[$item])) {
                $errors[$item] = 'Поле не заполнено';
            }
        }

        $deadline = null;
        if (!empty($_POST['lot-date'])) {
            if ($_POST['lot-date'] != is_date_valid($_POST['lot-date']) || $_POST['lot-date'] < date("Y-m-d")) {
                $errors['lot-date'] = 'Дата не корректна';
            } else {
                $deadline = $_POST['lot-date'];
            }
        }

        $err_category = 0;
        foreach ($list_categories as $key => $value) {
            if ($value['title'] === $_POST['category']) {
                $category_id = $value['id'];
                $err_category = 1;
            }
        }
        if (!$err_category) {
            $errors['category'] = "Категории не существует";
        }

        $url_file = null;
        if (isset($_FILES['lot-img'])) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            $file_name = $_FILES['lot-img']['name'];
            $file_path = __DIR__ . '/uploads/';
            $url_file = '/uploads/' . $file_name;

            if ($url_file == '/uploads/') {
                $errors['lot-img'] = 'Вы не загрузили файл в правильном формате';
            }

            $file_type = finfo_file($finfo, $file_path);

            move_uploaded_file($_FILES['lot-img']['tmp_name'], $file_path . $file_name);

        } else {
            $errors['lot-img'] = 'Вы не загрузили файл в правильном формате';
        }

        if (count($errors)) {
            $page_content = include_template('add_lot.php', ['errors[$item]' => $errors[$item], 'errors' => $errors, 'categories' => $list_categories]);
        } else {

            $sql = "INSERT INTO lots (dt_add, article, category_id, description, url_picture, start_price, step, deadline, user_author) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = db_get_prepare_stmt($con, $sql, [$_POST['lot-name'], $category_id, $_POST['message'], $url_file, $lot_rate, $lot_step, $_POST['lot-date'], $users_id]);
            $res = mysqli_stmt_execute($stmt);

            if ($res) {
                $lot_id = mysqli_insert_id($con);
                header("Location: lot.php?lots=" . $lot_id);
            } else {
                http_response_code(404);
                header("Location: 404.php");
                exit();
            }
        }
    } else {
        $page_content = include_template('add_lot.php', ['categories' => $list_categories, 'errors' => $errors]);
    }
}

$layout_content = include_template('layout.php', ['content' => $page_content, 'categories' => $list_categories, 'user_author' => $user_name]);
print ($layout_content);
