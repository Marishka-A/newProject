<?php
session_start();
if (isset($_SESSION['user'])) {
    error_log("Пользователь авторизован.");
} else {
    header('Location: firstpage.php');
    error_log("Пользователь  не авторизован.");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Портфолио</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/stylereg.css" rel="stylesheet">
</head>

<body>
    <div class="main-form">
        <div class="topColumn">
            <div class="topIcon">
                <img src="img/leftTopAngle.png" alt="icon">
            </div>
            <ul class="top-actions">
                <li class="menu-item">
                    <a href="" class="menu-link">О создателях</a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">Лучшие проекты сервиса</a>
                </li>
                <li class="menu-item">
                    <a href="/profile.html" class="menu-link">Профиль</a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>