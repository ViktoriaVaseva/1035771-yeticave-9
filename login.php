<?php
$con = mysqli_connect("yeticave", "root", "","yeticave");
mysqli_set_charset($con, "utf8");
require_once ('helpers.php');
require_once ('function.php');

$sql = "SELECT * FROM categories";
$list_categories = db_fetch_data($con, $sql, []);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $required = ['email', 'password'];
    $errors = [];

    foreach ($required as $val) {
        if (empty($_POST[$val])) {
            $errors[$val] = 'Поле не заполнено';
        }
    }

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $sql);

    $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

    if (!count($errors) and $user) {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user;

        } else {
            $errors['password'] = 'Неверный пароль';
        }
    } else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    if (count($errors)) {
        $page_content = include_template('login.php', ['errors' => $errors]);
    }  else {
        header("Location: index.php");
        exit();
    }
} else {
    $page_content = include_template('login.php');
}
$page_layout = include_template('layout.php', ['content' => $page_content, 'categories' => $list_categories]);
print ($page_layout);