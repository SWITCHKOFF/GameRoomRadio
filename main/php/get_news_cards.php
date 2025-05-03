<?php
require_once 'db_connection.php';
require_once 'format_date.php';

try {
    // Получение первых 10 новостей
    $stmt = $pdo->query("SELECT n.news_id, n.news_title, n.news_date, 
                                n.news_image_path
                         FROM news n
                         ORDER BY n.news_date DESC
                         LIMIT 4");
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Формирование HTML для каждой новости
    foreach ($news as $item) {
        $imagePath = $item['news_image_path'] ? htmlspecialchars($item['news_image_path']) : '../img/webp/album.webp';
        $formattedDate = formatRussianDate($item['news_date']);
        $dateParts = explode(' ', $formattedDate);
        $date = implode(' ', array_slice($dateParts, 0, 3)) . ' г.';
        $time = $dateParts[3];
        
        echo '<div class="news-card">';
        echo '<div class="news-card__picture" style="background-image: url(' . $imagePath . ');">';
        echo '</div>';
        echo '<div class="news-card__info">';
        echo '<h2>' . htmlspecialchars($item['news_title']) . '</h2>';
        echo '</div>';
        echo '<div class="news-card__info-advanced">';
        echo '<div class="news-card__options">';
        echo '<button class="news-card__like" data-news-id="' . $item['news_id'] . '">';
        echo '<img loading="lazy" src="../img/svg/likes.svg" alt="news like">';
        echo '</button>';
        echo '<button class="news-card__bookmark" data-news-id="' . $item['news_id'] . '">';
        echo '<img loading="lazy" src="../img/svg/bookmarks.svg" alt="news bookmark">';
        echo '</button>';
        echo '</div>';
        echo '<span class="news-card__date">' . $date . '<br>' . $time . '</span>';
        echo '</div>';
        echo '</div>';
    }
    
} catch(PDOException $e) {
    // В случае ошибки выводим сообщение
    echo '<div class="error-message">Ошибка при загрузке новостей: ' . $e->getMessage() . '</div>';
}
?> 