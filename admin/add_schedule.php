<?php
require_once 'config.php'; // Подключение к базе данных

// Проверка подключения к базе данных
if (!$dbconn) {
    die("Ошибка подключения к базе данных: " . pg_last_error());
}

// Проверка, существует ли таблица class_schedule
$result = pg_query($dbconn, "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
if (!$result) {
    die("Ошибка при выполнении запроса на проверку таблиц: " . pg_last_error($dbconn));
}

$number_of_lessons = $_POST['number_of_lessons'] ?? null;

// Проверка, что данные переданы
$class_number = $_POST['class_number'] ?? null;
$class_letter = $_POST['class_letter'] ?? null;

if (empty($class_number) || empty($class_letter) || empty($number_of_lessons)) {
    die("Ошибка: не все поля формы заполнены.");
}

// Проходим по каждому уроку
for ($i = 1; $i <= $number_of_lessons; $i++) {
    // Получение данных из формы
    $subject_name = $_POST['subject_name_' . $i] ?? null;
    $room_number = $_POST['room_number_' . $i] ?? null;
    $day_of_week = $_POST['day_of_week_' . $i] ?? null;
    $lesson_start_time = $_POST['lesson_start_time_' . $i] ?? null;
    $lesson_end_time = $_POST['lesson_end_time_' . $i] ?? null;

    // Проверка данных для каждого урока
    if (empty($subject_name) || empty($room_number) || empty($day_of_week) || empty($lesson_start_time) || empty($lesson_end_time)) {
        echo "Ошибка: не все данные заполнены для урока $i.<br>";
        continue;
    }

    // Подготовка SQL-запроса с параметрами
    $query = "INSERT INTO public.class_schedule 
        (class_number, class_letter, lesson_order, subject_name, room_number, day_of_week, lesson_start_time, lesson_end_time)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";

    // Выполнение подготовленного запроса
    $result = pg_query_params($dbconn, $query, array(
        $class_number,
        $class_letter,
        $i,
        $subject_name,
        $room_number,
        $day_of_week,
        $lesson_start_time,
        $lesson_end_time
    ));

    if (!$result) {
        echo "Ошибка при добавлении урока $i: " . pg_last_error($dbconn) . "<br>";
    } else {
        echo "Урок $i успешно добавлен!<br>";
    }
}

// Закрываем подключение к базе данных только после выполнения всех операций
pg_close($dbconn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление расписания</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .modal {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .modal h2 {
            margin-bottom: 20px;
        }
        .modal button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="modal">
    <h2>Расписание успешно добавлено!</h2>
    <button onclick="goBack()">ОК</button>
</div>

<script>
    function goBack() {
        window.location.href = 'raspisanie.html'; // Перенаправление на страницу добавления расписания
    }
</script>

</body>
</html>
