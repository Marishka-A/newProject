<?php
session_start();

$login = $_POST['login-reg'];
$email = $_POST['email-reg'];
$password = $_POST['password-reg'];
$password_confirm = $_POST['password-confirm'];

$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
$user = $result->fetch_assoc();

$result1 = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
$user1 = $result1->fetch_assoc();

if (empty($login) || empty($email) || empty($password) || empty($password_confirm)) {
    $response = array('status' => 'error', 'message' => 'Ошибка: все поля должны быть заполнены!');
    echo json_encode($response);
} else {
    if (mb_strlen($login) < 5 || mb_strlen($login) > 15) {
        $response = array('status' => 'error', 'message' => 'Ошибка: длина логина должна быть от 5 до 15 символов!');
        echo json_encode($response);
    } else if (mb_strlen($password) < 5) {
        $response = array('status' => 'error', 'message' => 'Ошибка: длина пароля должна быть не менее 5 символов!');
        echo json_encode($response);
    } else if (!empty($user)) {
        $response = array('status' => 'error', 'message' => 'Ошибка: указанный логин уже занят!');
        echo json_encode($response);
    } else if (!empty($user1)) {
        $response = array('status' => 'error', 'message' => 'Ошибка: указанный email уже зарегистрирован!');
        echo json_encode($response);
    } else if ($password != $password_confirm) {
        $response = array('status' => 'error', 'message' => 'Ошибка: пароли не совпадают!');
        echo json_encode($response);
    } else {
        $pass = md5($password . "masito");

        $mysql->query("INSERT INTO `users` (`login`, `email`, `password`) VALUES('$login', '$email', '$pass')");

        $_SESSION['user'] = $login;

        $response = array('status' => 'success', 'message' => 'Регистрация прошла успешно!');
        echo json_encode($response);
        exit();
    }
}
$mysql->close();
