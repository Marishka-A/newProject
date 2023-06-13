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
    <link href="css/stylecatalog.css" rel="stylesheet">
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
                    <a href="" class="menu-link">Лучшие проекты сервиса</a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo $profileLink; ?>" class="menu-link"><?php echo $profileText; ?></a>
                </li>
            </ul>
        </div>
        <button id="scrollTopBtn" onclick="scrollToTop()">Вверх</button>
        <div class="catalog">
            <div class="catalog-header">Каталог пользователей</div>
            <hr>
            <ul class="filters">
                <li class="filter-item">Фильтры:</li>
                <li class="filter-item">
                    <div style="margin-right: 10px;">Сфера деятельности:</div>
                    <select id="sphere-select">
                        <option>Любая</option>
                        <option>Дизайн</option>
                        <option>Разработка</option>
                        <option>Образование</option>
                        <option>Аналитика</option>
                        <option>Медицина</option>
                        <option>Маркетинг и реклама</option>
                        <option>Фотография</option>
                    </select>
                </li>
                <li class="filter-item">
                    <div style="margin-right: 10px;">Рейтинг:</div>
                    <div class="from-to">От:</div>
                    <select name="from" style="margin-right: 10px;" id="rating-from-select">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div class="from-to">До:</div>
                    <select name="to" id="rating-to-select">
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </li>
            </ul>
            <hr style="margin-bottom: 40px;">
            <div class="profile-list">
                <?php include 'inc/createProfiles.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sphere-select, #rating-from-select, #rating-to-select').change(function() {
            var selectedSphere = $('#sphere-select').val();
            var selectedRatingFrom = parseFloat($('#rating-from-select').val());
            var selectedRatingTo = parseFloat($('#rating-to-select').val());

            $('.profile-item').hide();

            $('.profile-item').each(function() {
                var sphere = $(this).find('.profession').text();
                var stars = $(this).find('.estimation .star-row img');
                var rating = 0;

                stars.each(function() {
                    var src = $(this).attr('src');
                    if (src.includes('star.png')) {
                        rating += 0;
                    } else if (src.includes('star-full.png')) {
                        rating += 1;
                    } else if (src.includes('star-half.png')) {
                        rating += 0.5;
                    }
                });

                if ((selectedSphere === 'Любая' || sphere === selectedSphere) &&
                    rating >= selectedRatingFrom &&
                    rating <= selectedRatingTo) {
                    $(this).show();
                }
            });
        });
    });
</script>

<script>
    function scrollToTop() {
        document.documentElement.scrollTop = 0;
    }

    window.addEventListener('scroll', function() {
        var scrollTopBtn = document.getElementById('scrollTopBtn');

        if (window.pageYOffset > 100) {
            scrollTopBtn.style.display = 'block';
        } else {
            scrollTopBtn.style.display = 'none';
        }
    });
</script>