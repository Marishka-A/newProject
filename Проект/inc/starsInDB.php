<?php
session_start();
$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');
$selectedStars = $_POST["selectedStars"];

if (!isset($_SESSION['user'])) {
    exit();
}

$login = $_SESSION['user'];
$sql = "SELECT * FROM `users` WHERE `login` = '$login'";
$result = $mysql->query($sql);
$row = $result->fetch_assoc();
$profileId = $row['id'];


$userId = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE `id` = $userId";
$result = $mysql->query($sql);
$row = $result->fetch_assoc();
$rating = $row['rating'];
$score = $row['score'];

$sql2 = "SELECT * FROM `visits` WHERE `profile_id` = '$userId' AND `user_id` = '$profileId'";
$result = $mysql->query($sql2);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $rating1 = $row['rating'];


    $sql = "UPDATE `users` SET `rating` = $rating - $rating1 + $selectedStars WHERE `id` = $userId";
    $stmt = $mysql->prepare($sql);
    $stmt->execute();

    $sql = "UPDATE `visits` SET `rating` = $selectedStars WHERE `profile_id` = '$userId' AND `user_id` = '$profileId'";
    $stmt = $mysql->prepare($sql);
    $stmt->execute();
    $mysql->close();

    $response = array('score' => $score);
    echo json_encode($response);
    exit();
}



$sql = "UPDATE `users` SET `rating` = $rating + $selectedStars WHERE `id` = $userId";
$stmt = $mysql->prepare($sql);
$stmt->execute();


$sql = "UPDATE `users` SET `score` = $score + 1 WHERE `id` = $userId";
$stmt = $mysql->prepare($sql);
$stmt->execute();

$sql = "INSERT INTO `visits` (user_id, profile_id, rating) VALUES (?, ?, ?)";
$stmt = $mysql->prepare($sql);
$stmt->bind_param("iii", $profileId, $userId, $selectedStars);
$stmt->execute();

$response = array('score' => $score + 1);
echo json_encode($response);


$mysql->close();
