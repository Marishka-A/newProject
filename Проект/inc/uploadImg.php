<?php
session_start();
$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

$login = $_SESSION['user'];

$uploadDir = '../temp/user-projects/';
$userDir = $uploadDir . $login . '/';

if (!file_exists($userDir)) {
    mkdir($userDir, 0777, true);
}

if (!empty($_FILES)) {
    foreach ($_FILES as $key => $file) {
        $tmpName = $file['tmp_name'];
        $targetPath = $userDir . basename($file['name']);

        if (move_uploaded_file($tmpName, $targetPath)) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
    }
}

$update = "UPDATE `users` SET `projects-dir` = '$userDir' WHERE `login` = '$login'";
$mysql->query($update);

$mysql->close();
