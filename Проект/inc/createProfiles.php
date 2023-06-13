<?php

$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

$profileId = -1;

if (isset($_SESSION['user'])) {
    $login = $_SESSION['user'];
    $sql = "SELECT * FROM `users` WHERE `login` = '$login'";
    $result = $mysql->query($sql);
    $row = $result->fetch_assoc();
    $profileId = $row['id'];
}


$sql = "SELECT * FROM users";
$result = $mysql->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $userId = $row["id"];
        $userName = $row["name"];
        $userSurname = $row["surname"];
        $userProfession = $row["specialization"];
        $userScore = $row['score'];
        $pictureName = $row['pict-name'];
        $userRating = 0;
        if ($userScore > 0)
            $userRating = $row['rating'] / $userScore;

        $html = '<div class="profile-list">
                    <div class="profile-item">
                        <img class="photo-profile" src = "temp/user-img/' . $pictureName . '.png"></img>
                        <div class="about">
                            <div class="name-surname">
                                <div class="name" style="margin-right: 10px;">' . $userName . '</div>
                                <div class="surname">' . $userSurname . '</div>
                            </div>
                            <div class="profession">' . $userProfession . '</div>
                        </div>
                        <div class="estimation">
                            <div class="star-row" style="margin: 0 0;">';
        for ($i = 0; $i < 3; $i++) {
            if ($i < $userRating) {
                $html .= '<img src="img/star-full.png" alt="icon" class="img-star">';
            } else {
                $html .= '<img src="img/star.png" alt="icon" class="img-star">';
            }
        }
        $html .= '</div>
                    <div class="star-row">';
        for ($i = 0; $i < 2; $i++) {
            if ($i < $userRating - 3) {
                $html .= '<img src="img/star-full.png" alt="icon" class="second-row-star">';
            } else {
                $html .= '<img src="img/star.png" alt="icon" class="second-row-star">';
            }
        }
        $html .= '</div>
                    <div>Оценили ' . $userScore . ' раз(а)</div>
                </div>
                <a href="' . (($userId == $profileId) ? 'profile.php' : 'profileInCatalog.php?id=' . $userId) . '" class="watch-profile">
                    <p class="watch-profile-text">Посмотреть профиль</p>
                </a>
            </div>
        </div>';

        echo $html;
    }
} else {
    echo "Нет пользователей в базе данных.";
}

$mysql->close();
