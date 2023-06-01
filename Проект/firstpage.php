<?php
session_start();
if (!empty($_SESSION['message']))
    $message = $_SESSION['message'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Портфолио</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!--Верхняя часть страницы-->
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
                    <a href="#input_window" class="menu-link">Вход</a>
                </li>
            </ul>
        </div>
    </div>
    <!--Окно входа-->
    <div class="main-form">
        <form id="input_window" class="input-window" action="inc/signup.php" method="post">
            <div class="input-top-icon"><img class="input-icon" src="img/leftTopAngle.png" alt="icon"></div>
            <div class="input-header">Добро пожаловать в Digital-portfolio</div>
            <div class="input-content">
                <label class="name-input-box" for="mail">Адрес электронной почты</label>
                <input class="input-box" id="mail" type="email" name="email">
                <label class="name-input-box" for="password">Пароль</label>
                <input class="input-box" id="password" type="password" name="password" style="margin-bottom: 4px;">
                <a class="forgot-password name-input-box" href="">Забыли пароль?</a>
                <button class="btn btn-input2">
                    <div class="btn_text btn_text2">Войти</div>
                </button>
                <p class="or">или</p>
                <div class="input-with">
                    <div class="name-input-box name-input-box-with">Войдите с помощью:</div>
                    <a href=""><img src="img/vk.png" alt="icon" class="vk-img"></a>
                </div>
                <p class="name-input-box name-input-box-with" style="width: auto; margin-top: 20px;">Ещё не зарегестрировались?</p>
                <a href="#register_window" class="btn btn-input2 btn-register">
                    <div class="btn_text btn_text2">Регистрация</div>
                </a>
            </div>
        </form>
        <!--Окно регистрации-->
        <form id="register_window" class="input-window" action="inc/register.php" method="post">
            <div class="input-top-icon"><img class="input-icon" src="img/leftTopAngle.png" alt="icon"></div>
            <div class="input-header">Регистрация</div>
            <div class="input-content">
                <label class="name-input-box" for="mail">Логин</label>
                <input class="input-box" type="text" name="login-reg" style="margin-bottom: 40px;">
                <div class="error-message" id="error-login" style="margin-top: -35px;"></div>
                <label class="name-input-box" for="email-reg">Адрес электронной почты</label>
                <input class="input-box" type="email" name="email-reg">
                <div class="error-message" id="error-mail"></div>
                <label class="name-input-box" for="password-reg">Пароль</label>
                <input class="input-box" type="password" name="password-reg" style="margin-bottom: 4px;">
                <label class="name-input-box" for="password-confirm">Подтвердите пароль</label>
                <input class="input-box" type="password" name="password-confirm">
                <div class="error-message" id="error-pass"></div>
                <button class="btn btn-input2 btn-register" id="reg-btn">
                    <div class="btn_text btn_text2">Регистрация</div>
                </button>
                <p class="or">или</p>
                <div class="input-with">
                    <div class="name-input-box name-input-box-with">Войдите с помощью:</div>
                    <a href=""><img src="img/vk.png" alt="icon" class="vk-img"></a>
                </div>
            </div>
        </form>
        <!--Текст и картинка на странице-->
        <div class="stage">
            <div class="content">
                <h1 class="stage_title">Создай свое Digital Portfolio</h1>
                <p class="stage_text">Удобный веб-сервис для организации, хранения, публикации проектов и достижений, которые позволяют оценить профессионализм и навыки человека.</p>
                <a href="#input_window" class="btn btn-input">
                    <div class="btn_text">Вход</div>
                </a>
            </div>
            <img src="img/mainImg.png" alt="img">
        </div>
    </div>
</body>

</html>

<!--Проверка паролей на совпадение-->
<!-- <script language="JavaScript">
    var z = document.getElementsByName('password-confirm');
    var x = document.getElementsByName('password-reg');
    var a = document.getElementsByName('login-reg');
    var b = document.getElementsByName('email-reg');

    var btn = document.getElementById("reg-btn");
    var check = false;
    var check2 = false;
    var check3 = false;

    z[0].oninput = function() {
        var pass = x[0].value;
        var pasconf = z[0].value;
        var err = document.getElementById('error-pass');
        if (pasconf != pass) {
            err.innerText = 'Пароли не совпадают';
            check = false;
            btn.setAttribute('disabled', true);
        } else {
            err.innerText = '';
            check = true;
        }
    }
    x[0].oninput = function() {
        var pass = x[0].value;
        var pasconf = z[0].value;
        var err = document.getElementById('error-pass');
        if (pasconf != pass) {
            err.innerText = 'Пароли не совпадают';
            btn.setAttribute('disabled', true);
        } else {
            err.innerText = '';
        }
    }
    a[0].oninput = function() {
        var login = a[0].value;
        var err1 = document.getElementById('error-login');
        if (login.length < 4) {
            err1.innerText = 'Логин должен содержать хотя бы 4 символа';
            check2 = false;
            btn.setAttribute('disabled', true);
        } else {
            err1.innerText = '';
            check2 = true;
        }
    }
    b[0].oninput = function() {
        var email = b[0].value;
        var err1 = document.getElementById('error-mail');
        if (email.length < 1) {
            err1.innerText = 'Введите почту';
            check3 = false;
            btn.setAttribute('disabled', true);
        } else {
            err1.innerText = '';
            check3 = true;
        }
    }
</script> -->