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
</head>

<body>
    <div class="main-form">
        <div class="topColumn">
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
                    <a href="<?php echo $profileLink; ?>" class="menu-link"><?php echo $profileText; ?></a>
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
                    <li class="proff" style="margin-top: 30px;">Оцените профиль:</li>
                    <li>
                        <ul>
                            <li class="star-row" style="margin-top: 10px;"><img src=" img/star.png" alt="icon" class="star"><img src="img/star.png" alt="icon" class="img-star star"><img src="img/star.png" alt="icon" class="star"></li>
                            <li class="star-row"><img src="img/star.png" alt="icon" class="second-row-star star"><img src="img/star.png" alt="icon" class="second-row-star star"></li>
                        </ul>
                    </li>
                    <!-- <li>
                        <ul>
                            <li class="menu-item2" style="justify-content: center;">
                                <div class="proff" style="margin-right: 10px;">Оценили</div>
                                <div class="proff" style="margin-right: 10px;" id="score">0</div>
                                <div class="proff">раз(а)</div>
                            </li>
                        </ul>
                    </li> -->
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
</body>

</html>

<script src="inc/stars.js"></script>

<script>
    var imageContainer = document.getElementById('imageContainer');
    var fileContainer = document.getElementById('fileContainer');

    var urlParams = new URLSearchParams(window.location.search);
    var userId = urlParams.get('id');

    fetch('inc/imgOnProfile.php?id=' + userId)
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
    var urlParams = new URLSearchParams(window.location.search);
    var userId = urlParams.get("id");

    function getRating() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'inc/checkStars.php?id=' + userId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var rating = response.rating;
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

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = " . $userId;
    $result = $mysql->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $userName = $row["name"];
        $userSurname = $row["surname"];
        $userProfession = $row["specialization"];
        $userRating = $row["rating"];
        $userCountry = $row["country"];
        $userCity = $row["town"];
        $userPhone = $row["number"];
        $userEmail = $row["email"];
        $userTelegram = $row["tg"];
        $userWhatsApp = $row["wa"];
        $userVK = $row["vk"];
        $userAbout = str_replace(array("\r\n", "\r", "\n"), '<br>', $row["about"]);
        $pictureName = $row['pict-name'];
        $rating = $row['rating'];
        $score = $row['score'];



        echo '<script>
                document.getElementById("picture").src = "temp/user-img/' . $pictureName . '.png";
                document.getElementById("name").innerHTML = "' . $userName . '";
                document.getElementById("surname").innerHTML = "' . $userSurname . '";
                document.getElementById("specialization").innerHTML = "' . $userProfession . '";
                document.getElementById("country").innerHTML = "' . $userCountry . '";
                document.getElementById("town").innerHTML = "' . $userCity . '";
                document.getElementById("number").innerHTML = "' . $userPhone . '";
                document.getElementById("email").innerHTML = "' . $userEmail . '";
                document.getElementById("tg").href = "' . $userTelegram . '";
                document.getElementById("wa").href = "' . $userWhatsApp . '";
                document.getElementById("vk").href = "' . $userVK . '";
                document.getElementById("about").innerHTML = "' . $userAbout . '";
            </script>';
    } else {
        echo "Пользователь не найден.";
    }
} else {
    echo "Неверный запрос.";
}

$mysql->close();
?>