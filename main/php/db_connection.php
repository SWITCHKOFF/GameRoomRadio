<?php

$host = '127.0.0.1'; // Или ваш хост
$dbname = 'PYTHONCOURSE'; // Имя вашей базы данных
$username = 'root'; // Ваше имя пользователя базы данных
$password = ''; // Ваш пароль базы данных

$pdo = null;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Настройка PDO для выброса исключений в случае ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Обработка ошибки подключения
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Возвращаем объект PDO для использования в других скриптах
return $pdo;

?>