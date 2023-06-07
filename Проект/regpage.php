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
                    <a href="" class="menu-link">Вход</a>
                </li>
            </ul>
        </div>
        <div class="reg">
            <p class="reg-header">Общедоступный профиль</p>
            <p class="reg-header-2">В вашем профиле можно будет увидеть указанную информацию</p>
        </div>
        <!--Сообщение об ошибке-->
        <div id="error-message">
            <span class="error-message-content"></span>
            <span class="closebtn" onclick="del()">×</span>
        </div>
        <!--Форма регистрации-->
        <form id="main_info" action="inc/register2.php" method="post" enctype="multipart/form-data">
            <div class="reg-content">
                <canvas id="avatarCanvas" name="avatarCanvas" class="photo"></canvas>
                <label for="avatarInput" class="change-photo">
                    <p class="change-photo-text">Изменить Аватар</p>
                    <input type="file" id="avatarInput" accept="image/*" name="avatarFile" required>
                </label>

                <p class="reg-header-2 info">Контактные данные</p>

                <label class="input-box-reg-text" for="name">Имя</label>
                <input type="text" class="input-box-reg-name" name="name"></input>

                <label class="input-box-reg-text surname" for="surname">Фамилия</label>
                <input type="text" class="input-box-reg-name input-box-reg-surname" name="surname"></input>

                <label class="input-box-reg-text" for="country">Страна</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="country"></input>

                <label class="input-box-reg-text" for="town">Город проживания</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="town"></input>

                <label class="input-box-reg-text" for="number">Номер телефона</label>
                <input type="tel" placeholder="Введите номер формата: +7xxxxxxxxxx" class="input-box-reg-name input-box-reg" name="number"></input>

                <p class="reg-header-2 info">Вы в соц. сетях</p>
                <p class="annotation">(оставьте сслылки на ваши аккаунты в социальных сетях)</p>

                <label class="input-box-reg-text" for="tg">Telegram</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="tg"></input>

                <label class="input-box-reg-text" for="wa">WhatsApp</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="wa"></input>

                <label class="input-box-reg-text" for="vk">ВКонтакте</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="vk"></input>

                <p class="reg-header-2 info">Основная информация</p>

                <label class="input-box-reg-text" for="birthday">Дата рождения</label>
                <input type="date" class="input-box-reg-name input-box-reg" name="birthday"></input>

                <p class="input-box-reg-text" style="font-size: 16px;">Сфера вашей деятельности из предложенных категорий:</p>
                <ul id="specialization-menu">
                    <li class="menu-item2">
                        <div class="specialization" name="specialization">
                            <p class="specialization-text">Дизайн</p>
                        </div>
                        <div class="specialization" name="specialization">
                            <p class="specialization-text">Разработка</p>
                        </div>
                        <div class="specialization" name="specialization">
                            <p class="specialization-text">Образование</p>
                        </div>
                        <div class="specialization" name="specialization">
                            <p class="specialization-text">Аналитика</p>
                        </div>
                    </li>
                    <li class="menu-item2">
                        <div class="specialization" name="specialization" style="margin-left: 35px;">
                            <p class="specialization-text">Медицина</p>
                        </div>
                        <div class="specialization" name="specialization">
                            <p class="specialization-text">Маркетинг и реклама</p>
                        </div>
                        <div class="specialization" name="specialization">
                            <p class="specialization-text">Фотография</p>
                        </div>
                    </li>
                </ul>

                <p class="input-box-reg-text" style="font-size: 16px;">О себе</p>
                <textarea type="text" name="about" id="" class="about" maxlength="3000"></textarea>
                <p class="input-box-reg-text" style="font-size: 16px;">Добавьте свои проекты</p>
                <input class="projects" type="file" name="" id="" multiple="true">
                <button class="btn-input btn-save">
                    <p class="save-text">Сохранить изменения</p>
                </button>
            </div>
        </form>
    </div>
</body>

</html>

<script src="inc/regpagescripts.js"></script>

<?php

$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

$login = $_SESSION['user'];

$sql = "SELECT * FROM `users` WHERE `login` = '$login'";
$result = $mysql->query($sql);

$row = $result->fetch_assoc();

$pictureName = $row['pict-name'];

echo '<script>document.getElementById("picture").src = "temp/' . $pictureName . '.png";</script>';
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