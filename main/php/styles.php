<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

$styles = [];

switch ($currentPage) {
    case 'main':
        $styles = [
            "../fonts/importFonts.css",
            "../css/header.min.css",
            "../css/player.min.css",
            "../css/main.min.css",
            "../css/swiper.min.css",
            "../css/footer.min.css",
        ];
        break;

    case 'about':
        $styles = [
            "../scss/importFonts.scss",
            "../scss/header.scss",
            "../scss/about.scss",
            "../scss/footer.scss",
        ];
        break;

    case 'support':
        $styles = [
            "../scss/importFonts.scss",
            "../scss/header.scss",
            "../scss/support.scss",
            "../scss/footer.scss",
        ];
        break;

    case '404':
        $styles = [
            "../scss/importFonts.scss",
            "../scss/header.scss",
            "../scss/404.scss",
            "../scss/footer.scss",
        ];
        break;

    default:
        $styles = [
            "../scss/importFonts.scss",
            "../scss/header.scss",
            "../scss/footer.scss",
        ];
        break;
}

foreach ($styles as $style) {
    echo "<link rel='stylesheet' href='$style'>";
}
?>