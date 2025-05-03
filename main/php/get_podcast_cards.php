<?php
require_once 'db_connection.php';
require_once 'format_date.php';

try {
    // Получение первых 10 подкастов
    $stmt = $pdo->query("SELECT p.podcast_id, p.podcast_title, p.podcast_desc, p.podcast_date, 
                                p.podcast_image_path
                         FROM podcasts p
                         ORDER BY p.podcast_date DESC
                         LIMIT 10");
    $podcasts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Формирование HTML для каждого подкаста
    foreach ($podcasts as $podcast) {
        $imagePath = $podcast['podcast_image_path'] ? htmlspecialchars($podcast['podcast_image_path']) : '../img/webp/album.webp';
        $formattedDate = formatRussianDate($podcast['podcast_date']);
        $dateParts = explode(' ', $formattedDate);
        $date = implode(' ', array_slice($dateParts, 0, 3)) . ' г.';
        $time = $dateParts[3];
        
        echo '<div class="podcast-card">';
        echo '<div class="podcast-card__picture" style="background-image: url(' . $imagePath . ');">';
        echo '</div>';
        echo '<div class="podcast-card__info">';
        echo '<h2>' . htmlspecialchars($podcast['podcast_title']) . '</h2>';
        echo '<p>' . htmlspecialchars($podcast['podcast_desc']) . '</p>';
        echo '</div>';
        echo '<div class="podcast-card__info-advanced">';
        echo '<div class="podcast-card__options">';
        echo '<button class="podcast-card__like" data-podcast-id="' . $podcast['podcast_id'] . '">';
        echo '<img loading="lazy" src="../img/svg/likes.svg" alt="podcast like">';
        echo '</button>';
        echo '<button class="podcast-card__bookmark" data-podcast-id="' . $podcast['podcast_id'] . '">';
        echo '<img loading="lazy" src="../img/svg/bookmarks.svg" alt="podcast bookmark">';
        echo '</button>';
        echo '</div>';
        echo '<span class="podcast-card__date">' . $date . '<br>' . $time . '</span>';
        echo '</div>';
        echo '</div>';
    }
    
} catch(PDOException $e) {
    // В случае ошибки выводим сообщение
    echo '<div class="error-message">Ошибка при загрузке подкастов: ' . $e->getMessage() . '</div>';
}
?> 