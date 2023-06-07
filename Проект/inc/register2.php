<?php
session_start();

$login = $_SESSION['user'];

$pictrue = $_POST['avatarCanvas'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$country = $_POST['country'];
$town = $_POST['town'];
$number = $_POST['number'];
$tg = $_POST['tg'];
$vk = $_POST['vk'];
$wa = $_POST['wa'];
$birthday = $_POST['birthday'];
$specialization = $_POST['specialization'];
$about = $_POST['about'];


$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

if (empty($name) || empty($surname) || empty($country) || empty($town)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: контактные данные должны быть заполнены!');
    echo json_encode($response);
} else if (empty($birthday)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: основные данные должны быть заполнены!');
    echo json_encode($response);
} else if (!validatePhone($number)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: неверный формат номера телефона!');
    echo json_encode($response);
} else {
    $update = "UPDATE `users` SET `picture` = '$pictrue',`name` = '$name', `surname` = '$surname', `country` = '$country',
     `town` = '$town', `number` = '$number', `tg` = '$tg', `vk` = '$vk', `wa` = '$wa', `birthday` = '$birthday',`specialization` = '$specialization', `about` = '$about' WHERE `login` = '$login'";
    $mysql->query($update);
    $response = array('status' => 'success', 'message' => 'Регистрация прошла успешно!');
    echo json_encode($response);
    exit();
}

$mysql->close();

function validatePhone($phone)
{
    $phoneRegex = '/^\+7\d{10}$/';

    if (preg_match($phoneRegex, $phone)) {
        return true;
    } else {
        return false;
    }
}
