<?php
// Включаем отображение ошибок для отладки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

// Получение статистики посещений на сегодня
$query = "
    SELECT COUNT(DISTINCT hep_transaction.pin) AS today_count,
           (COUNT(DISTINCT hep_transaction.pin)::decimal / (SELECT COUNT(*) FROM pers_person)) * 100 AS today_percentage
    FROM hep_transaction
    WHERE event_time::date = CURRENT_DATE
";
$result = pg_query($dbconn, $query);
if (!$result) {
    die('Ошибка выполнения запроса: ' . pg_last_error($dbconn));
}
$stats = pg_fetch_assoc($result);

// Получение списка учеников, которые посетили столовую сегодня
$query = "
    SELECT DISTINCT ON (hep_transaction.pin) 
           hep_transaction.pin, hep_transaction.last_name, hep_transaction.name, hep_transaction.event_time, hep_transaction.dept_name
    FROM hep_transaction
    WHERE event_time::date = CURRENT_DATE
    ORDER BY hep_transaction.pin, hep_transaction.event_time DESC
";
$result = pg_query($dbconn, $query);
if (!$result) {
    die('Ошибка выполнения запроса: ' . pg_last_error($dbconn));
}
$visits = pg_fetch_all($result);

// Получение всех пользователей с их датами рождения
$query = "
    SELECT pers_person.name, pers_person.last_name, pers_person.birthday, pers_attribute_ext.attr_value3 AS class
    FROM pers_person
    JOIN pers_attribute_ext ON pers_person.id = pers_attribute_ext.person_id
";
$result = pg_query($dbconn, $query);
if (!$result) {
    die('Ошибка выполнения запроса: ' . pg_last_error($dbconn));
}
$persons = pg_fetch_all($result);

// Получение данных о школе (замените на реальные данные, если они доступны)
$school_info = [
    'name' => 'Название школы',
    'director' => 'Имя директора',
    'phone' => '+7 (123) 456-78-90',
    'address' => 'Адрес школы',
    'photo' => 'img/school.png' // Путь к фото школы
];

// Возвращаем данные в формате JSON
echo json_encode([
    'stats' => $stats,
    'visits' => $visits,
    'school_info' => $school_info,
    'persons' => $persons
]);

pg_close($dbconn);
?>
