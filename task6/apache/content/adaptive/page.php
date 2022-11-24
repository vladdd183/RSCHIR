<?php
session_start();
$themeStyleSheet = 'css/light_theme.css';
if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
    $themeStyleSheet = 'css/dark_theme.css';
}
$lang = "ru";
if (!empty($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
    $lang = "en";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Прака 5 адаптив</title>
        <link href="<?php echo $themeStyleSheet; ?>" rel="stylesheet" id="theme-link">
    </head>
    <?php if ($lang == "ru"):
        include "lang/ru/page.php"
        ?>
    <?php else:
        include "lang/en/page.php"
        ?>
    <?php endif ?>
    <script src="js/cookies.js"></script>
</html>

