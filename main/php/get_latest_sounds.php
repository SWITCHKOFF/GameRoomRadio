<?php

// Подключение к базе данных
$pdo = require_once 'db_connection.php';
require_once 'format_date.php';

try {
    // Получение всех песен
    $stmt = $pdo->query("SELECT s.song_id, s.song_name, s.song_author, s.song_date, 
                                s.song_image_path,
                                'Песня' as sound_type
                         FROM songs s");
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Получение всех подкастов
    $stmt = $pdo->query("SELECT p.podcast_id, p.podcast_title as song_name, p.podcast_desc as song_author, p.podcast_date as song_date, 
                                p.podcast_image_path as song_image_path,
                                'Подкаст' as sound_type
                         FROM podcasts p");
    $podcasts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Объединяем все звуки
    $all_sounds = array_merge($songs, $podcasts);
    
    // Сортируем по дате в обратном порядке (самые новые сначала)
    usort($all_sounds, function($a, $b) {
        return strtotime($b['song_date']) - strtotime($a['song_date']);
    });
    
    // Берем только первые 4 элемента (самые новые)
    $all_sounds = array_slice($all_sounds, 0, 4);
    
    // Формирование HTML для каждого звука
    foreach ($all_sounds as $sound) {
        $imagePath = $sound['song_image_path'] ? htmlspecialchars($sound['song_image_path']) : '../img/webp/album.webp';
        $displayName = $sound['sound_type'] === 'Песня' 
            ? htmlspecialchars($sound['song_name'] . ' - ' . $sound['song_author'])
            : htmlspecialchars($sound['song_name']);
        
        // Определяем ID в зависимости от типа
        $soundId = $sound['sound_type'] === 'Песня' ? $sound['song_id'] : $sound['podcast_id'];
            
        echo '<div class="sound-container">';
        echo '<button class="sound-container__play" style="background-image: url(' . $imagePath . ') !important;">';
        echo '<img loading="lazy" src="../img/svg/play.svg">';
        echo '</button>';
        echo '<div class="sound-info">';
        echo '<span class="sound-type">' . htmlspecialchars($sound['sound_type']) . '</span>';
        echo '<span class="sound-name">' . $displayName . '</span>';
        echo '</div>';
        echo '<div class="sound-info-advanced">';
        echo '<div class="sound-options">';
        echo '<button class="sound-like" data-sound-id="' . $soundId . '" data-sound-type="' . strtolower($sound['sound_type']) . '">';
        echo '<img loading="lazy" src="../img/svg/likes.svg" alt="like">';
        echo '</button>';
        echo '<button class="sound-bookmark" data-sound-id="' . $soundId . '" data-sound-type="' . strtolower($sound['sound_type']) . '">';
        echo '<img loading="lazy" src="../img/svg/bookmarks.svg" alt="bookmark">';
        echo '</button>';
        echo '</div>';
        echo '<span class="sound-date">' . formatRussianDate($sound['song_date']) . '</span>';
        echo '</div>';
        echo '</div>';
    }
    
} catch(PDOException $e) {
    // В случае ошибки выводим сообщение
    echo '<div class="error-message">Ошибка при загрузке звуков: ' . $e->getMessage() . '</div>';
}
?>