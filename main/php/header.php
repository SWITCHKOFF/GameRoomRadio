<header>
    <div class="header-container">
        <a href="main.php" class="header-logo">
            <img loading="lazy" src="../img/svg/logo.svg" alt="logotype">
            <span>GAMEROOM<br>RADIO</span>
        </a>
        <div class="header-menu__option-songs">
            <a href="../search_songs.php">Песни</a>
        </div>
        <div class="header-menu__option-podcasts">
            <a href="../search_podcasts.php">Подкасты</a>
        </div>
        <div class="header-menu__option-news">
            <a href="../search_news.php">Новости</a>
        </div>
        <div class="header-menu__option-about">
            <a href="../about.php">О нас</a>
        </div>
        <div class="header-menu__option-support">
            <a href="../support.php">Поддержка</a>
        </div>
        <div class="header-menu__search">
            <div class="search-container">
                <form action="process_header_search.php" method="POST">
                    <button type="submit" id="searchButton" class="search-button">
                        <img loading="lazy" src="../img/svg/search.svg" alt="search">
                    </button>
                    <input type="text" name="search" class="search-input" placeholder="Поиск" required>
                </form>
            </div>
        </div>
        <div class="header-menu__user-options">
            <div class="user-options__option-likes">
                <a href="../404.php"><img src="../img/svg/likes.svg"></a>
            </div>
            <div class="user-options__option-bookmarks">
                <a href="../404.php"><img src="../img/svg/bookmarks.svg"></a>
            </div>
            <div class="user-options__option-user">
                <a href="../404.php"><img src="../img/svg/user.svg"></a>
            </div>
        </div>
    </div>
</header>