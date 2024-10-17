<?php
// Включаем отображение ошибок для отладки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';


// Получение всех пользователей с их датами рождения
$query = "
    SELECT 
    pers_person.name, 
    pers_person.last_name, 
    pers_person.birthday, 
    hep_transaction.dept_name AS class
FROM 
    pers_person
JOIN 
    (SELECT DISTINCT ON (pin) pin, dept_name 
     FROM hep_transaction
     ORDER BY pin, create_time DESC) AS hep_transaction 
    ON pers_person.pin = hep_transaction.pin
";
$result = pg_query($dbconn, $query);
if (!$result) {
    die('Ошибка выполнения запроса: ' . pg_last_error($dbconn));
}
$persons = pg_fetch_all($result);

// Получение данных о школе (замените на реальные данные, если они доступны)
$school_info = [
    'name' => 'Школа-гимназия №22',
    'director' => 'Сапаров Арслан Хамитович',
    'phone' => '+7 (123) 456-78-90',
    'address' => 'Адрес Абылай хана 19/2',
];

// Возвращаем данные в формате JSON
echo json_encode([
    'school_info' => $school_info,
    'persons' => $persons
]);

pg_close($dbconn);
?>
