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
        image.src = "temp/user-img/' . $pictureName . '.png";
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
    $about = str_replace(array("\r\n", "\r", "\n"), ' ', $row["about"]);
    echo '<script>document.getElementById("about").value = \'' . $about . '\';</script>';
}

$mysql->close();
