<?php
require_once 'config.php';

// Сначала получаем всех классных руководителей с их классами
$query_teachers = "
    SELECT pers_person.last_name, pers_person.name, 
           hep_transaction.dept_name AS class
    FROM pers_person
    JOIN pers_attribute_ext ON pers_person.id = pers_attribute_ext.person_id
    LEFT JOIN hep_transaction ON pers_person.pin = hep_transaction.pin
    WHERE pers_attribute_ext.attr_value3 = 'Классный руководитель'
";
$result_teachers = pg_query($dbconn, $query_teachers);
$teachers = pg_fetch_all($result_teachers);

$class_teachers = [];
if ($teachers) {
    foreach ($teachers as $teacher) {
        $class_teachers[$teacher['class']] = $teacher['last_name'] . ' ' . $teacher['name'];
    }
}

// Теперь получаем всех учеников и их данные
$query_students = "
    SELECT DISTINCT ON (pers_person.pin) 
       pers_person.last_name, 
       pers_person.name, 
       pers_person.birthday, 
       hep_transaction.dept_name AS class, 
       CASE 
           WHEN pers_attribute_ext.attr_value4 = 'Да' THEN 'Да'
           ELSE 'Нет'
       END AS budget_status
FROM pers_person
LEFT JOIN pers_attribute_ext ON pers_person.id = pers_attribute_ext.person_id
LEFT JOIN hep_transaction ON pers_person.pin = hep_transaction.pin
WHERE pers_attribute_ext.attr_value3 = 'Ученик'
ORDER BY pers_person.pin, hep_transaction.event_time DESC;

";
$result_students = pg_query($dbconn, $query_students);
$students = pg_fetch_all($result_students);

// Проверяем на ошибки
if (!$result_students) {
    die('Ошибка выполнения запроса: ' . pg_last_error($dbconn));
}

// Добавляем классного руководителя к каждому студенту, если такой есть
foreach ($students as &$student) {
    $student['class_teacher'] = $class_teachers[$student['class']] ?? '';
}

// Возвращаем данные в формате JSON
echo json_encode([
    'students' => $students,
]);

pg_close($dbconn);
?>
