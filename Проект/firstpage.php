<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Портфолио</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
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
                <input class="input-box" type="text" placeholder="Длина 5-15 символов." name="login-reg" style="margin-bottom: 40px;">

                <label class="name-input-box" for="email-reg">Адрес электронной почты</label>
                <input class="input-box" type="email" name="email-reg">

                <label class="name-input-box" for="password-reg">Пароль</label>
                <input class="input-box" type="password" placeholder="Длина не менее 5 символов." name="password-reg" style="margin-bottom: 4px;">

                <label class="name-input-box" for="password-confirm">Подтвердите пароль</label>
                <input class="input-box" type="password" name="password-confirm">

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
        <!--Сообщение об ошибке-->
        <div id="error-message">
            <span class="error-message-content"></span>
            <span class="closebtn" onclick="del()">×</span>
        </div>
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

<script src="inc/firstpagescripts.js"></script>