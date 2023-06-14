<?php
session_start();
$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');
$login = $_SESSION['user'];

$pictrue = $_POST['avatarCanvas'];

$sql = "SELECT * FROM `users` WHERE `login` = '$login'";
$result = $mysql->query($sql);

$row = $result->fetch_assoc();

if (!empty($row['pict-name'])) {
    $filename = $row['pict-name'];
} else {
    $filename = generateRandomFileName();
}

$base64Image = $pictrue;

$base64Image = str_replace('data:image/png;base64,', '', $base64Image);

$base64Image = str_replace(' ', '+', $base64Image);

$data = base64_decode($base64Image);

file_put_contents('../temp/user-img/' . $filename . '.png', $data);

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


if (empty($name)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: поле "Имя" должно быть заполнено!');
    echo json_encode($response);
} else if (empty($surname)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: поле "Фамилия" должна быть заполнена!');
    echo json_encode($response);
} else if (empty($country)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: поле "Страна" должна быть заполнена!');
    echo json_encode($response);
} else if (empty($town)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: поле "Город" должно быть заполнено!');
    echo json_encode($response);
} else if (empty($birthday)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: поле "Дата рождения" должно быть заполнено!');
    echo json_encode($response);
} else if (empty($specialization)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: поле "Сфера деятельности" должно быть выбрано!');
    echo json_encode($response);
} else if (empty($number)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: поле "Номер телефона" должно быть заполнено!');
    echo json_encode($response);
} else if (!validatePhone($number)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: неверный формат номера телефона!');
    echo json_encode($response);
} else {
    $update = "UPDATE `users` SET `pict-name` = '$filename', `name` = '$name', `surname` = '$surname', `country` = '$country',
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

function generateRandomFileName()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = 10;
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
