<?php
function give_new_price($price) {
    $new_price = ceil($price);

    if ($new_price >= 1000) {
        $new_price = number_format($price,0,',', ' ');
    }

    return $new_price . ' ₽';
};

date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU');
function rest_time($deadline) {
    $next = strtotime($deadline);
    $current_time = time();
    $secs_to_midnight = $next - $current_time;
    $hours = floor($secs_to_midnight / 3600);
    $minutes = floor(($secs_to_midnight % 3600) / 60);

    return $hours . ':' . $minutes;
};

function db_fetch_data($link, $sql, $data = []) {
    $result = [];
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res) {
        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    return $result;
}


function db_insert_data($link, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        $result = mysqli_insert_id($link);
    }
    return $result;
}