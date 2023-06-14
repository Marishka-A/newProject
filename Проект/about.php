<?php
session_start();
if (isset($_SESSION['user'])) {
    $profileLink = "../profile.php";
    $profileText = "Профиль";
} else {
    $profileLink = "../firstpage.php";
    $profileText = "Вход";
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
    <link href="css/styleabout.css" rel="stylesheet">
</head>

<body>
    <!--Верхние меню-->
    <div class="main-form">
        <div class="topColumn" style="position: sticky; top: 0; background:#d1d3d3;">
            <div class="topIcon">
                <img src="img/leftTopAngle.png" alt="icon">
            </div>
            <ul class="top-actions">
                <li class="menu-item">
                    <a href="" class="menu-link">О создателях</a>
                </li>
                <li class="menu-item">
                    <a href="mainpage.php" class="menu-link">Лучшие проекты сервиса</a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo $profileLink; ?>" class="menu-link"><?php echo $profileText; ?></a>
                </li>
            </ul>
        </div>
        <div style="margin-top: 50px;"> </div>
        <!--О нас заголовок-->
        <div style="margin-left: 50px;">
            <div class="reg">
                <p class="about-header">О создателях</p>
            </div>
            <div class="titleColumn">
                <div class="aboutUs">

                    <p class="about-title">Проектная команда</p>
                    <p class="about-title">Veb Lemyau</p>
                    <p class="about-title2">“Покажи всем свои достижения, пусть мама тобой гордится!”</p>
                </div>
                <div class="logo">
                    <img src="img/logo1.png" alt="icon">
                </div>
            </div>
        </div>
        <!--О нас 1-->
        <div class="perconInfo">
            <div class="person_photo"><img src="img/Marina1.png" alt="icon"></div>
            <div class="person_name">Абросимова Марина</div>
            <div class="person_work">Тимлид</div>
            <div class="person_disc1">Опора проекта</div>
            <div class="person_disc2">Ответственная и понимающая</div>
        </div>
        <div style="margin-top: 200px;"> </div>
        <!--О нас 2-->
        <div class="perconInfo">
            <div class="person_photo"><img src="img/Roma.png" alt="icon"></div>
            <div class="person_name">Новиков Роман</div>
            <div class="person_work">Разработчик</div>
            <div class="person_disc1">Мозги проекта</div>
            <div class="person_disc2">Самостоятельный и любящий поспать</div>
        </div>
        <div style="margin-top: 200px;"> </div>
        <!--О нас 3-->
        <div class="perconInfo">
            <div class="person_photo"><img src="img/Anna.png" alt="icon"></div>
            <div class="person_name">Ребак Анна</div>
            <div class="person_work">Разработчик</div>
            <div class="person_disc1">Мозги проекта 2.0</div>
            <div class="person_disc2">Доброжелательная и оптимистичная</div>
        </div>
        <div style="margin-top: 200px;"> </div>
        <!--О нас 4-->
        <div class="perconInfo">
            <div class="person_photo"><img src="img/Lada.png" alt="icon"></div>
            <div class="person_name">Мартемьянова Лада</div>
            <div class="person_work">Дизайнер</div>
            <div class="person_disc1">Красота проекта</div>
            <div class="person_disc2">Креативная и позитивная</div>
        </div>
        <div style="margin-top: 200px;"> </div>
        <!--О нас 5-->
        <div class="perconInfo">
            <div class="person_photo"><img src="img/Karina.png" alt="icon"></div>
            <div class="person_name">Гагарина Карина</div>
            <div class="person_work">Аналитик</div>
            <div class="person_disc1">Анализ проекта</div>
            <div class="person_disc2">Целеустремленная и мечтательная</div>
        </div>
        <div style="margin-top: 200px;"> </div>
    </div>
</body>

</html>