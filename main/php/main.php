<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/svg/favicon.svg" type="image/x-icon">
    <?php require_once 'styles.php'; ?>
    <title>Главная</title>
</head>
<body>
    <?php require_once 'header.php'; ?>
    <main>
        <?php require_once 'slider.php'; ?>
        <?php require_once 'player.php'; ?>
        <div id="sounds-container" class="sounds-block">
            <div class="songs-search-form-container">
                <form action="process_song_search.php" method="POST">
                    <h2>Поиск песен</h2>
                    <div class="songs-form-date">
                        <label for="date">Дата эфира:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="songs-form-time">
                        <label for="time">Время эфира:</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                    <div class="songs-form-submit">
                        <button id="songs-search" type="submit" value="submit">Найти песни</button>
                    </div>
                </form>
            </div>
            <h2>Что было в эфире?</h2>
            <div class="last-sounds__loader-container" style="display: none">
                <div class="loader"></div>
            </div>
            <?php include 'get_latest_sounds.php'; ?>
            <button id="sounds-showAll" class="sounds-showAll">Показать ещё</button>
        </div>
        <div class="podcasts-block">
            <div class="podcasts__search-block">
                <form action="process_podcast_search.php" method="POST">
                    <h2>Поиск подкастов</h2>
                    <div class="podcasts__form-date">
                        <label for="date">Дата эфира:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="podcasts__form-time">
                        <label for="time">Время эфира:</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                    <div class="podcasts__form-submit">
                        <button id="podcasts-search" type="submit" value="submit">Найти подкасты</button>
                    </div>
                </form>
            </div>
            <div id="podcasts-container">
                <div class="podcasts__loader-container">
                    <div class="loader" style="display: none"></div>
                </div>
                <?php include 'get_podcast_cards.php'; ?>
            </div>
            <div class="podcasts-button__showAll-container">
                <button id="podcasts-button__showAll">Показать ещё</button>
            </div>
        </div>
        <div class="news-block">
            <div class="news__search-block">
                <form action="process_news_search.php" method="POST">
                    <h2>Поиск новостей</h2>
                    <div class="news__form-search">
                        <label for="news__search">Поиск</label>
                        <input type="text" id="news__search" name="news__search" required>
                    </div>
                    <div class="news__form-submit">
                        <button id="news-search" type="submit" value="submit">Найти новости</button>
                    </div>
                </form>
            </div>
            <div id="news-container">
                <div class="news__loader-container">
                    <div class="loader" style="display: none"></div>
                </div>
                <?php include 'get_news_cards.php'; ?>
            </div>
            <div class="news-button__showAll-container">
                <button id="news-button__showAll">Показать ещё</button>
            </div>
        </div>
    </main>
    <?php require_once 'footer.php'; ?>
<script src="../js/swiper.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        },
        pagination: {
        el: ".swiper-pagination",
        clickable: true,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        },
    });
    </script>
</body>
</html>