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
        <div class="topColumn" style="position: sticky; top: 0; background:#d1d3d3;">
            <div class="topIcon">
                <img src="img/leftTopAngle.png" alt="icon">
            </div>
            <ul class="top-actions">
                <li class="menu-item">
                    <a href="about.php" class="menu-link">О создателях</a>
                </li>
                <li class="menu-item">
                    <a href="mainpage.php" class="menu-link">Лучшие проекты сервиса</a>
                </li>
                <li class="menu-item">
                    <a href="#delete-btn" class="menu-link">Выйти</a>
                </li>
            </ul>
        </div>
        <div class="content-profile">
            <img class="photo photo-profile" id="picture">
            <div class="Name-surname">
                <ul>
                    <li class="menu-item2">
                        <div class="name_surname" id="name" style="margin-right: 10px;">Имя</div>
                        <div class="name_surname" id="surname">Фамилия</div>
                    </li>
                    <li class="proff" id="specialization">Профессия</li>
                    <li>
                        <ul>
                            <li class="star-row"><img src="img/star.png" alt="icon" class="star"><img src="img/star.png" alt="icon" class="img-star star"><img src="img/star.png" alt="icon" class="star"></li>
                            <li class="star-row"><img src="img/star.png" alt="icon" class="second-row-star star"><img src="img/star.png" alt="icon" class="second-row-star star"></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="menu-item2" style="justify-content: center;">
                                <div class="proff" style="margin-right: 10px;">Оценили</div>
                                <div class="proff" style="margin-right: 10px;" id="score">0</div>
                                <div class="proff">раз(а)</div>
                            </li>
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
                        <div class="about-item" style="margin-bottom: 25px;">Почта</div>
                        <div id="email">почта</div>
                    </li>
                    <li class="menu-item-image">
                        <ul class="menu-item2">
                            <li class="menu-item2 image"><a href="" id="tg"><img src="img/tg.png" alt="icon"></a></li>
                            <li class="menu-item2 image"><a href="" id="wa"><img src="img/wa.png" alt="icon"></a></li>
                            <li class="menu-item2 image"><a href="" id="vk"><img src="img/vk2.png" alt="icon"></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <p class="about-you">О себе</p>
        <div class="text-about-you">
            <p class="text-ay" id="about"></p>
        </div>
        <p class="about-you" style="margin-top: 40px;">Проекты:</p>
        <div style="margin-left: 180px; margin-bottom: 20px;">
            <p class="about-you project-text">Файлы:</p>
            <div class="container-for-files">
                <div class="project-block" id="fileContainer"></div>
            </div>
            <p class="about-you project-text">Изображения:</p>
            <div class="container-for-files">
                <div class="project-block" id="imageContainer"></div>
            </div>
        </div>
        <div class="change-btn">
            <a class="btn-input btn-save change" href="regpage.php">
                <p class="change-text">Редактировать профиль</p>
            </a>
        </div>
        <form action="inc/logout.php" class="delete" id="delete-btn">
            <button class="btn btn-input2" style="margin: 0;">
                <div class="btn_text btn_text2 change-text" style="color: white;">Выйти из аккаунта</div>
            </button>
        </form>
</body>

</html>

<script>
    var imageContainer = document.getElementById('imageContainer');
    var fileContainer = document.getElementById('fileContainer');

    fetch('inc/imgOnProfile.php')
        .then(response => response.text())
        .then(html => {
            imageContainer.innerHTML = extractImageHTML(html);
            fileContainer.innerHTML = extractFileHTML(html);
        })
        .catch(error => console.log(error));

    function extractImageHTML(html) {
        const tempContainer = document.createElement('div');
        tempContainer.innerHTML = html;

        const imageDivs = tempContainer.querySelectorAll('.project-block img');

        const imageHTML = Array.from(imageDivs).map(div => div.outerHTML).join('');

        return imageHTML;
    }

    function extractFileHTML(html) {
        const tempContainer = document.createElement('div');
        tempContainer.innerHTML = html;

        const fileDivs = tempContainer.querySelectorAll('.project-block a');
        const fileHTML = Array.from(fileDivs).map(div => '-' + div.outerHTML + '<br>').join('');

        return fileHTML;
    }
</script>

<script>
    function getRating() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'inc/checkStarsProfile.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var rating = response.rating;
                console.log(rating);
                replaceStars(rating);
            }
        };
        xhr.send();
    }


    function replaceStars(rating) {
        var starImages = document.getElementsByClassName('star');
        var starFullImage = 'img/star-full.png';

        for (var i = 0; i < starImages.length; i++) {
            var starImage = starImages[i];
            if (i < rating) {
                starImage.src = starFullImage;
            }
        }
    }

    getRating();
</script>

<?php

$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

$login = $_SESSION['user'];

$sql = "SELECT * FROM `users` WHERE `login` = '$login'";
$result = $mysql->query($sql);

$row = $result->fetch_assoc();

$pictureName = $row['pict-name'];

$about = str_replace(array("\r\n", "\r", "\n"), '<br>', $row["about"]);

echo '<script>document.getElementById("picture").src = "temp/user-img/' . $pictureName . '.png";</script>';
echo '<script>document.getElementById("name").innerHTML = \'' . $row["name"] . '\';</script>';
echo '<script>document.getElementById("surname").innerHTML = \'' . $row["surname"] . '\';</script>';
echo '<script>document.getElementById("specialization").innerHTML = \'' . $row["specialization"] . '\';</script>';
echo '<script>document.getElementById("country").innerHTML = \'' . $row["country"] . '\';</script>';
echo '<script>document.getElementById("town").innerHTML = \'' . $row["town"] . '\';</script>';
echo '<script>document.getElementById("number").innerHTML = \'' . $row["number"] . '\';</script>';
echo '<script>document.getElementById("email").innerHTML = \'' . $row["email"] . '\';</script>';
echo '<script>document.getElementById("tg").href = \'' . $row["tg"] . '\';</script>';
echo '<script>document.getElementById("wa").href = \'' . $row["wa"] . '\';</script>';
echo '<script>document.getElementById("vk").href = \'' . $row["vk"] . '\';</script>';
echo '<script>document.getElementById("about").innerHTML = \'' . $about . '\';</script>';
echo '<script>document.getElementById("score").innerHTML = \'' . $row["score"] . '\';</script>';


$mysql->close();
?>