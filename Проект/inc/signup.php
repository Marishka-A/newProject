<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pass = md5($password . "masito");

$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
$user = $result->fetch_assoc();
if (empty($user)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: данный пользователь не найден.');
    echo json_encode($response);
} else {
    $hashedPassword = $user['password'];

    if ($pass === $hashedPassword) {
        $_SESSION['user'] = $user['login'];
        $response = array('status' => 'success1');
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Ошибка: неправильный логин или пароль.');
        echo json_encode($response);
    }
}

$mysql->close();
