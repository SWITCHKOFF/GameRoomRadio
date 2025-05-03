<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    
    // Проверяем, что оба поля заполнены
    if (!empty($date) && !empty($time)) {
        // Формируем URL с параметрами поиска
        $searchParams = http_build_query([
            'date' => $date,
            'time' => $time
        ]);
        
        // Перенаправляем на страницу поиска с параметрами
        header("Location: search_songs.php?$searchParams");
        exit();
    } else {
        // Если поля не заполнены, возвращаем на главную с сообщением об ошибке
        header("Location: main.php?error=empty_fields");
        exit();
    }
} else {
    // Если запрос не POST, возвращаем на главную
    header("Location: main.php");
    exit();
}
?> 