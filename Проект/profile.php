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
        <div class="content-profile">
            <img type="file" class="photo photo-profile" id="picture"></img>
            <div class="Name-surname">
                <ul>
                    <li class="menu-item2">
                        <div class="name_surname" id="name" style="margin-right: 10px;">Имя</div>
                        <div class="name_surname" id="surname">Фамилия</div>
                    </li>
                    <li class="proff" id="specialization">Профессия</li>
                    <li>
                        <ul>
                            <li class="star-row"><img src="img/star.png" alt="icon"><img src="img/star.png" alt="icon" class="img-star"><img src="img/star.png" alt="icon"></li>
                            <li style="margin-left: -35px;"><img src="img/star.png" alt="icon" class="img-star"><img src="img/star.png" alt="icon"></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="About-person">
                <ul>
                    <li class="menu-item2">
                        <div class="about-item" id>Страна</div>
                        <div id="country">страна</div>
                    </li>
                    <li class="menu-item2">
                        <div class="about-item" id>Город</div>
                        <div id="town">город</div>
                    </li>
                    <li class="menu-item2">
                        <div class="about-item">Телефон</div>
                        <div id="number">телефон</div>
                    </li>
                    <li class="menu-item2">
                        <div class="about-item" style="margin-bottom: 40px;">Почта</div>
                        <div id="email">почта</div>
                    </li>
                    <li class="menu-item-image">
                        <ul class="menu-item2">
                            <li class="menu-item2 image"><a href=""><img src="img/tg.png" alt="icon"></a></li>
                            <li class="menu-item2 image"><a href=""><img src="img/wa.png" alt="icon"></a></li>
                            <li class="menu-item2 image"><a href=""><img src="img/vk2.png" alt="icon"></a></li>
                        </ul>
                    </li>
                    <li class="menu-item2">
                        <div class="about-item">Подписки</div>
                        <div id="">подписки</div>
                    </li>
                    <li class="menu-item2">
                        <div class="about-item">Подписчики</div>
                        <div id="">подписчики</div>
                    </li>
                    <li class="menu-item2">
                        <div class="about-item">Оценки</div>
                        <div id="">оценки</div>
                    </li>
                </ul>
            </div>
            <a class="btn-input btn-save change change-text" href="regpage.php">
                <p style="margin-top: 10px;">Редактировать профиль</p>
            </a>
        </div>
        <p class="about-you">О себе</p>
        <div class="text-about-you">
            <p class="text-ay" id="about"></p>
        </div>
        <p class="about-you" style="margin-top: 60px;">Проекты</p>
        <div style="margin-bottom: 60px;"></div>
    </div>
</body>

</html>

<?php

$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

$login = $_SESSION['user'];

$sql = "SELECT `picture`, `name`, `surname`, `specialization`, `country`, `town`, `number`, `email`, `about` FROM `users` WHERE `login` = '$login'";
$result = $mysql->query($sql);

$row = $result->fetch_assoc();

// echo '<script>document.getElementById("picture").innerHTML = \'' . $row["picture"] . '\';</script>';
echo '<script>document.getElementById("picture").src = "data:image/jpeg;base64,' . base64_encode($row["picture"]) . '";</script>';
echo '<script>document.getElementById("name").innerHTML = \'' . $row["name"] . '\';</script>';
echo '<script>document.getElementById("surname").innerHTML = \'' . $row["surname"] . '\';</script>';
echo '<script>document.getElementById("specialization").innerHTML = \'' . $row["specialization"] . '\';</script>';
echo '<script>document.getElementById("country").innerHTML = \'' . $row["country"] . '\';</script>';
echo '<script>document.getElementById("town").innerHTML = \'' . $row["town"] . '\';</script>';
echo '<script>document.getElementById("number").innerHTML = \'' . $row["number"] . '\';</script>';
echo '<script>document.getElementById("email").innerHTML = \'' . $row["email"] . '\';</script>';
echo '<script>document.getElementById("name").innerHTML = \'' . $row["name"] . '\';</script>';
echo '<script>document.getElementById("name").innerHTML = \'' . $row["name"] . '\';</script>';
echo '<script>document.getElementById("name").innerHTML = \'' . $row["name"] . '\';</script>';
echo '<script>document.getElementById("about").innerHTML = \'' . $row["about"] . '\';</script>';


$mysql->close();
?>