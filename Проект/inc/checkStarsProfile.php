<?php
session_start();
if (!isset($_SESSION['user'])) {
    exit();
}
$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');


$login = $_SESSION['user'];
$sql = "SELECT * FROM `users` WHERE `login` = '$login'";
$result = $mysql->query($sql);
$row = $result->fetch_assoc();

$rating = $row['rating'];

$response = array('rating' => $rating);
echo json_encode($response);

$mysql->close();
