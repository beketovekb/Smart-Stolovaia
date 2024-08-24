<?php
$host = '127.0.0.1:5442';
$database = 'biosecurity-boot';
$user = 'root';
$password = '341833Beka';

// Создание строки подключения
$dbconn_string = "host=localhost port=5442 dbname=$database user=$user password=$password";

// Подключение к базе данных
$dbconn = pg_connect($dbconn_string) or die('Не удалось соединиться: ' . pg_last_error($dbconn));

?>
