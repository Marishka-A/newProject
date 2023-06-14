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

if ($row['score'] > 0) {
    $rating = $row['rating'] / $row['score'];
} else {
    $rating = 0;
}

$response = array('rating' => $rating);
echo json_encode($response);

$mysql->close();
