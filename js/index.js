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
            url: 'get_index.php', // Путь к PHP-файлу, который возвращает JSON данные
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                

                // Обновление данных о школе
                $('.school_name').text(data.school_info.name);
                $('.dir_name').text(data.school_info.director);
                $('.tel_number').text(data.school_info.phone);
                $('.adr_location').text(data.school_info.address);




                // Обновление поздравлений с днем рождения
const today = new Date();
let birthdayFound = false;
$('.bday_list').empty();  // Очищаем предыдущие данные

data.persons.forEach(function(person) {
    const birthday = new Date(person.birthday);
    if (birthday.getDate() === today.getDate() && birthday.getMonth() === today.getMonth()) {
        // Добавляем каждого именинника в список
        const nameElement = $('<span>').text(person.last_name + ' ' + person.name + ' ' + person.class + ' класс');
        const separator = $('<hr>').addClass('names_seperation');

        // Вставляем элементы в блок
        $('.bday_list').append(nameElement, separator);
        birthdayFound = true;
    }
});

if (!birthdayFound) {
    // Если именинников нет, выводим сообщение "Удачного дня!"
    const noBirthdayMessage = $('<span>').text('Удачного дня!');
    $('.bday_list').append(noBirthdayMessage);
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