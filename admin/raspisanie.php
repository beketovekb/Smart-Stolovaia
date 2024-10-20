<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление расписания</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .lessons_container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .lessons_container fieldset {
            flex: 1 1 calc(33.333% - 20px); /* Делим контейнер на три столбца с отступом */
            box-sizing: border-box;
        }
        @media (max-width: 768px) {
            .lessons_container fieldset {
                flex: 1 1 calc(50% - 20px); /* Делим контейнер на два столбца на меньших экранах */
            }
        }
        @media (max-width: 480px) {
            .lessons_container fieldset {
                flex: 1 1 100%; /* Один столбец на самых маленьких экранах */
            }
        }
    </style>
</head>
<body>
    
    <section class="main">
    <?php include 'admin_menu.html'; ?>
        <div class="general">
            <div class="filters_line">
                <div class="header_admin">
                    <span class="title">Добавить расписание уроков</span>
                </div>
            </div>
            <form class="form" id="scheduleForm" action="add_schedule.php" method="POST">
                <div class="wrap">
                    <label for="class_number" class="label">Номер класса:</label>
                    <select id="class_number" class="turnintodropdown" name="class_number" required>
                        <!-- Номера классов с 1 по 11 -->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                    </select>
                </div>
    
                <div class="wrap">
                    <label for="class_letter" class="label">Буква класса:</label>
                    <select id="class_letter" class="turnintodropdown" name="class_letter" required>
                        <!-- Казахский алфавит -->
                        <option value="А">А</option>
                        <option value="Ә">Ә</option>
                        <option value="Б">Б</option>
                        <option value="В">В</option>
                        <option value="Г">Г</option>
                        <option value="Ғ">Ғ</option>
                        <option value="Д">Д</option>
                        <option value="Е">Е</option>
                        <option value="Ё">Ё</option>
                        <option value="Ж">Ж</option>
                        <option value="З">З</option>
                        <option value="И">И</option>
                        <option value="Й">Й</option>
                        <option value="К">К</option>
                        <option value="Қ">Қ</option>
                        <option value="Л">Л</option>
                        <option value="М">М</option>
                        <option value="Н">Н</option>
                        <option value="Ң">Ң</option>
                        <option value="О">О</option>
                        <option value="Ө">Ө</option>
                        <option value="П">П</option>
                        <option value="Р">Р</option>
                        <option value="С">С</option>
                        <option value="Т">Т</option>
                        <option value="У">У</option>
                        <option value="Ұ">Ұ</option>
                        <option value="Ү">Ү</option>
                        <option value="Ф">Ф</option>
                        <option value="Х">Х</option>
                        <option value="Һ">Һ</option>
                        <option value="Ц">Ц</option>
                        <option value="Ч">Ч</option>
                        <option value="Ш">Ш</option>
                        <option value="Щ">Щ</option>
                        <option value="Ъ">Ъ</option>
                        <option value="Ы">Ы</option>
                        <option value="І">І</option>
                        <option value="Ь">Ь</option>
                        <option value="Э">Э</option>
                        <option value="Ю">Ю</option>
                        <option value="Я">Я</option>
                    </select>
                </div>

                <div class="wrap">
                    <label for="shift" class="label">Смена:</label>
                    <select id="shift" class="turnintodropdown" name="shift" required>
                        <option value="1">1 смена</option>
                        <option value="2">2 смена</option>
                    </select>
                </div>
    
                <div class="wrap">
                    <label for="number_of_lessons" class="label">Количество уроков:</label>
                    <div class="input_container">
                        <input type="number" class="turnintodropdown" id="number_of_lessons" value="0"  name="number_of_lessons" min="1" max="7" required><br>
                    </div>
                </div>

                <div class="wrap">
                    <div id="lessons_container" class="lessons_container"></div>
                </div>
                
                <input class="adding" type="submit" value="Добавить">
            </form>
        </div>
    </section>

    <script type='text/javascript' src='js/select.js'></script>
    <script>
        const scheduleTimes = {
            "1": [ // Время для первой смены
                {start: "08:00", end: "08:40"},
                {start: "08:50", end: "09:30"},
                {start: "09:45", end: "10:25"},
                {start: "10:40", end: "11:20"},
                {start: "11:30", end: "12:10"},
                {start: "12:15", end: "12:55"},
                {start: "13:00", end: "13:40"}
            ],
            "2": [ // Время для второй смены
                {start: "14:00", end: "14:40"},
                {start: "14:50", end: "15:30"},
                {start: "15:45", end: "16:25"},
                {start: "16:40", end: "17:20"},
                {start: "17:25", end: "18:05"},
                {start: "18:10", end: "18:50"}
            ]
        };

        $(document).ready(function() {
            $('#number_of_lessons').on('input', function() {
                const numberOfLessons = parseInt($(this).val(), 10);
                const lessonsContainer = $('#lessons_container');
                const selectedShift = $('#shift').val();

                lessonsContainer.empty(); // Очищаем контейнер

                for (let i = 1; i <= numberOfLessons; i++) {
                    const lessonTime = scheduleTimes[selectedShift][i-1];

                    lessonsContainer.append(`
                        <fieldset style="flex: ${numberOfLessons === 1 ? '1 1 100%' : '1 1 calc(33.333% - 20px)'};">
                            <legend>Урок ${i}</legend>
                            <div class="input_wrap">
                                <label for="subject_name_${i}">Название предмета:</label>
                                <input type="text" id="subject_name_${i}" name="subject_name_${i}" required>
                            </div>
                            <div class="input_wrap">
                                <label for="room_number_${i}">Номер кабинета:</label>
                                <input type="text" id="room_number_${i}" name="room_number_${i}" required>
                            </div>
                            <div class="input_wrap">
                                <label for="day_of_week_${i}">День недели:</label>
                                <select id="day_of_week_${i}" name="day_of_week_${i}" class="select" required>
                                    <option value="Понедельник">Понедельник</option>
                                    <option value="Вторник">Вторник</option>
                                    <option value="Среда">Среда</option>
                                    <option value="Четверг">Четверг</option>
                                    <option value="Пятница">Пятница</option>
                                    <option value="Суббота">Суббота</option>
                                </select>
                            </div>
                            <div class="input_wrap">
                                <label for="lesson_start_time_${i}">Время начала урока:</label>
                                <input type="text" id="lesson_start_time_${i}" name="lesson_start_time_${i}" value="${lessonTime.start}" readonly>
                            </div>
                            <div class="input_wrap">
                                <label for="lesson_end_time_${i}">Время окончания урока:</label>
                                <input type="text" id="lesson_end_time_${i}" name="lesson_end_time_${i}" value="${lessonTime.end}" readonly>
                            </div>
                        </fieldset>
                    `);
                }
            });

            // Переключение смены
            $('#shift').on('change', function() {
                $('#number_of_lessons').trigger('input'); // Обновляем уроки при смене
            });
        });
    </script>
</body>
</html>
