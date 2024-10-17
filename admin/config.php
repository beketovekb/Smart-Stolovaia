<?php
$host = 'localhost';  // Подключение к локальной базе данных
$database = 'biosecurity-boot';
$user = 'postgres';  // Убедитесь, что это правильный пользователь
$password = '341833Beka';  // Вставьте правильный пароль

// Создание строки подключения
$dbconn_string = "host=$host port=5432 dbname=$database user=$user password=$password";

// Подключение к базе данных
$dbconn = pg_connect($dbconn_string);

if (!$dbconn) {
    die("Ошибка подключения к базе данных: " . pg_last_error());
}

// Соединение успешно создано
?>
