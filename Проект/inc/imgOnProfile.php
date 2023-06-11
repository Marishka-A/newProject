<?php
session_start();
$mysql = new mysqli('localhost', 'root', 'hjvf', 'portfolio');

$login = $_SESSION['user'];

$uploadDir = '../temp/user-projects/';
$folderPath = $uploadDir . $login . '/';
$files = scandir($folderPath);



$images = array_filter($files, function ($file) {
    $extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
    return in_array(strtolower($fileExtension), $extensions);
});
$images = array_unique($images);

$otherFiles = array_filter($files, function ($file) use ($folderPath) {
    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
    $filePath = $folderPath . '/' . $file;
    return !is_dir($filePath) && !in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
});
$otherFiles = array_unique($otherFiles);
foreach ($images as $image) {
    $imagePath = $folderPath . '/' . $image;
    $imageSize = getimagesize($imagePath);
    $imageWidth = $imageSize[0];
    $imageHeight = $imageSize[1];

    if ($imageWidth > 600 || $imageHeight > 600) {
        echo '<div style="margin-bottom: 60px;" class="project-block">';
        echo '<img src="' . $imagePath . '" alt="' . $image . '" style="max-width: 600px; max-height: 600px;">';
        echo '</div>';
    } else {
        echo '<div style="margin-bottom: 60px;" class="project-block">';
        echo '<img src="' . $imagePath . '" alt="' . $image . '">';
        echo '</div>';
    }
}

foreach ($otherFiles as $file) {
    echo '<div style="margin-bottom: 60px;" class="project-block">';
    echo '<a href="' . $folderPath . '/' . $file . '" download>' . $file . '</a>';
    echo '</div>';
}
