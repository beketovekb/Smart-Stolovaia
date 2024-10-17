<?php
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
$visits = pg_fetch_all($result);

// Получение всех учеников с их датой рождения и классом
$query = "
    SELECT pers_person.name, pers_person.last_name, pers_person.birthday, pers_attribute_ext.attr_value3 AS class
    FROM pers_person
    JOIN pers_attribute_ext ON pers_person.id = pers_attribute_ext.person_id
";
$result = pg_query($dbconn, $query);
$birthdays = pg_fetch_all($result);

// Получение данных о посещаемости за текущий месяц
$query = "
    SELECT DATE(event_time) AS visit_date, COUNT(DISTINCT pin) AS student_count
    FROM hep_transaction
    WHERE DATE_TRUNC('month', event_time) = DATE_TRUNC('month', CURRENT_DATE)
    GROUP BY visit_date
    ORDER BY visit_date
";
$result = pg_query($dbconn, $query);
$attendance = pg_fetch_all($result);

// Получение данных о школе (замените на реальные данные, если они доступны)
$school_info = [
    'name' => 'Школа-гимназия №22',
    'director' => 'Сапаров Арслан Хамитович',
    'phone' => '+7 (7172) 16-22-32',
    'address' => 'Абылай хана 19/2',
    'photo' => 'img/school.png' // Путь к фото школы
];

// Возвращаем данные в формате JSON
echo json_encode([
    'stats' => $stats,
    'visits' => $visits,
    'school_info' => $school_info,
    'birthdays' => $birthdays,
    'attendance' => $attendance
]);

pg_close($dbconn);
?>
