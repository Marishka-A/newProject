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
                    <input type="file" id="avatarInput" accept="image/*" name="avatarFile">
                </label>

                <p class="reg-header-2 info">Контактные данные</p>

                <label class="input-box-reg-text" for="name">Имя</label>
                <input type="text" class="input-box-reg-name" name="name" id="name"></input>

                <label class="input-box-reg-text surname" for="surname">Фамилия</label>
                <input type="text" class="input-box-reg-name input-box-reg-surname" name="surname" id="surname"></input>

                <label class="input-box-reg-text" for="country">Страна</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="country" id="country"></input>

                <label class="input-box-reg-text" for="town">Город проживания</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="town" id="town"></input>

                <label class="input-box-reg-text" for="number">Номер телефона</label>
                <input type="tel" placeholder="Введите номер формата: +7xxxxxxxxxx" class="input-box-reg-name input-box-reg" name="number" id="number"></input>

                <p class="reg-header-2 info">Вы в соц. сетях</p>
                <p class="annotation">(оставьте сслылки на ваши аккаунты в социальных сетях)</p>

                <label class="input-box-reg-text" for="tg">Telegram</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="tg" id="tg"></input>

                <label class="input-box-reg-text" for="wa">WhatsApp</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="wa" id="wa"></input>

                <label class="input-box-reg-text" for="vk">ВКонтакте</label>
                <input type="text" class="input-box-reg-name input-box-reg" name="vk" id="vk"></input>

                <p class="reg-header-2 info">Основная информация</p>

                <label class="input-box-reg-text" for="birthday">Дата рождения</label>
                <input type="date" class="input-box-reg-name input-box-reg" name="birthday" id="birthday"></input>

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
                <textarea type="text" name="about" class="about" maxlength="3000" id="about"></textarea>
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
if (!empty($pictureName)) {
    echo '<script>
        var canvas = document.getElementById("avatarCanvas");
        var ctx = canvas.getContext("2d");
        var image = new Image();
        image.onload = function() {
            ctx.drawImage(image, 0, 0);
        };
        image.src = "temp/' . $pictureName . '.png";
    </script>';
}
if (!empty($row["name"])) {
    echo '<script>document.getElementById("name").value = \'' . $row["name"] . '\';</script>';
}
if (!empty($row["surname"])) {
    echo '<script>document.getElementById("surname").value = \'' . $row["surname"] . '\';</script>';
}
if (!empty($row["specialization"])) {
    $specialization = $row["specialization"];
    echo '<script>
            var specializations = document.querySelectorAll(\'div[name="specialization"]\');
            for (var i = 0; i < specializations.length; i++) {
                var specializationText = specializations[i].querySelector(".specialization-text");
                if (specializationText.textContent.trim() === "' . $specialization . '") {
                    specializations[i].style.backgroundColor = "#c29e68";
                }
            }
          </script>';
}
if (!empty($row["country"])) {
    echo '<script>document.getElementById("country").value = \'' . $row["country"] . '\';</script>';
}
if (!empty($row["town"])) {
    echo '<script>document.getElementById("town").value = \'' . $row["town"] . '\';</script>';
}
if (!empty($row["number"])) {
    echo '<script>document.getElementById("number").value = \'' . $row["number"] . '\';</script>';
}
if (!empty($row["tg"])) {
    echo '<script>document.getElementById("tg").value = \'' . $row["tg"] . '\';</script>';
}
if (!empty($row["vk"])) {
    echo '<script>document.getElementById("vk").value = \'' . $row["vk"] . '\';</script>';
}
if (!empty($row["wa"])) {
    echo '<script>document.getElementById("wa").vaulue = \'' . $row["wa"] . '\';</script>';
}
if (!empty($row["birthday"])) {
    $birthday = date('Y-m-d', strtotime($row["birthday"]));
    echo '<script>document.getElementById("birthday").value = \'' . $birthday . '\';</script>';
}
if (!empty($row["about"])) {
    echo '<script>document.getElementById("about").value = \'' . $row["about"] . '\';</script>';
}

$mysql->close();
?>