var kid=0;
       $(document).ready(function() {
    function updateData() {
        var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var hh = String(today.getHours());
if(today.getMinutes()<10)
var min = '0'+String(today.getMinutes());
else
var min = String(today.getMinutes());

today = dd + '.' + mm + '.' + yyyy;
tim = hh+':'+min;

        $('.day').text(today);
        $('.clock').text(tim);

        var days = [
  'Воскресенье',
  'Понедельник',
  'Вторник',
  'Среда',
  'Четверг',
  'Пятница',
  'Суббота'
];
var d = new Date();
var n = d.getDay();
$('.week').text(days[n]);
        $.ajax({
            url: 'get_data.php', // Путь к PHP-файлу, который возвращает JSON данные
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Обновление статистики
                animate(kid, data.stats.today_percentage);
                kid=Math.floor(data.stats.today_percentage);
                
                $('.enter_people').text(data.stats.today_count);
                $('.enter_procent').text(Math.floor(data.stats.today_percentage) + '%');

                // Обновление данных о школе
                $('.school_name').text(data.school_info.name);
                $('.dir_name').text(data.school_info.director);
                $('.tel_number').text(data.school_info.phone);
                $('.adr_location').text(data.school_info.address);
                $('.school_img').css('background-image', 'url(' + data.school_info.photo + ')');

                // Очистка таблицы перед обновлением данных
                $('.right_content').empty();

                // Заполнение таблицы данными о посещениях
                data.visits.forEach(function(visit, index) {
                    var rowClass = (index % 2 === 0) ? 'dark' : 'light';
                    var row = '<div class="table_line ' + rowClass + '">' +
                        '<span class="t_1 table_fio_value">' + visit.last_name + ' ' + visit.name + '</span>' +
                        '<span class="t_2 table_class_value">' + visit.dept_name + '</span>' +
                        '<span class="t_3 table_time_value">' + visit.event_time + '</span>' +
                        '</div>';
                    $('.right_content').append(row);
                });

                // Обновление поздравлений с днем рождения
                const today = new Date();
                let birthdayFound = false;

                data.persons.forEach(function(person) {
                    const birthday = new Date(person.birthday);
                    if (birthday.getDate() === today.getDate() && birthday.getMonth() === today.getMonth()) {
                        $('.student_name').text(person.last_name + ' ' + person.name);
                        $('.student_class').text(person.dept_name);
                        $('.photo_student').css('background-image', 'url(img/student_photo.png)');
                        birthdayFound = true;
                    }
                });

                if (!birthdayFound) {
                    // Если именинников нет, выводим сообщение "Удачного дня!"
                    $('.student_name').text('Удачного дня!');
                    $('.student_class').text('');
                    $('.photo_student').css('background-image', 'none');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Ошибка при загрузке данных: ' + textStatus, errorThrown);
            }
        });
    }

    // Обновление данных при загрузке страницы
    updateData();

    // Обновление данных каждую минуту
    setInterval(updateData, 100);
});