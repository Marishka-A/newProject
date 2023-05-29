<?php

session_start();
require_once 'connect.php';

$login = $_POST['login-reg'];
$email = $_POST['email-reg'];
$password = $_POST['password-reg'];
$password_confirm = $_POST['password-confirm'];
/* $first_name = $_POST['first-name'];
$last_name = $_POST['last-name'];
$country = $_POST['country'];
$city = $_POST['city'];
$phone = $_POST['phone'];
$public_mail = $_POST['public-mail'];
$birthday = $_POST['birthday'];
$tg = $_POST['tg'];
$vk = $_POST['vk'];
$wa = $_POST['wa']; */

if ($password == $password_confirm) {
    $sql = "INSERT INTO `users` (login, password, email) VALUES ('$login', '$password', '$email')";
    $connect->query($sql);
    header('Location: /regpage.php');
} else {
    header('Location: /firstpage.php');
}
