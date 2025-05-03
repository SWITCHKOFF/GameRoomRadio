<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $searchQuery = $_POST['search'] ?? '';
    
    // Проверяем, что поле поиска заполнено
    if (!empty($searchQuery)) {
        // Формируем URL с параметрами поиска
        $searchParams = http_build_query([
            'query' => $searchQuery
        ]);
        
        // Перенаправляем на страницу поиска с параметрами
        header("Location: search.php?$searchParams");
        exit();
    } else {
        // Если поле не заполнено, возвращаем на главную с сообщением об ошибке
        header("Location: main.php?error=empty_search");
        exit();
    }
} else {
    // Если запрос не POST, возвращаем на главную
    header("Location: main.php");
    exit();
}
?>