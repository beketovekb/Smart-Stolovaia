var kid = 0;
$(document).ready(function () {
    function updateAdminData() {
        $.ajax({
            url: 'admin_data.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Обновление статистики
                console.log(Math.floor(data.stats.today_percentage));
                animate(kid, Math.floor(data.stats.today_percentage));
                kid = Math.floor(data.stats.today_percentage);
                $('.enter_people').text(data.stats.today_count);
                $('.enter_procent').text(Math.floor(data.stats.today_percentage) + '%');

                // Обновление информации о школе
                $('.school_name').text(data.school_info.name);
                $('.dir_name').text(data.school_info.director);
                $('.tel_number').text(data.school_info.phone);
                $('.adr_location').text(data.school_info.address);
                $('.school_img').css('background-image', 'url(' + data.school_info.photo + ')');

                // Обновление поздравлений с днём рождения
                const today = new Date();
                let foundBirthday = false;

                data.birthdays.forEach(function (student) {
                    const birthday = new Date(student.birthday);
                    if (birthday.getDate() === today.getDate() && birthday.getMonth() === today.getMonth()) {
                        $('.student_name').text(student.last_name + ' ' + student.name);
                        $('.student_class').text(student.class);
                        foundBirthday = true;
                    }
                });

                if (!foundBirthday) {
                    $('.student_name').text('Удачного дня!');
                    $('.student_class').text('');
                }

                // Очистка перед построением диаграммы посещаемости
                if (window.chart) {
                    window.chart.destroy();
                }

                // Построение диаграммы посещаемости
                var options = {
                    series: [{
                        name: 'Посещаемость',
                        data: data.attendance.map(entry => entry.student_count)
                    }],
                    chart: {
                        height: 350,
                        type: 'bar',
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            show: true,
                            tools: {
                                download: true,
                                selection: true,
                                zoom: true,
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: true
                            },
                            offsetX: 0,  // Смещение по горизонтали (оставим по умолчанию)
                            offsetY: 0,  // Смещение по вертикали (оставим по умолчанию)
                            position: 'right',  // Позиция справа
                            tools: {
                                download: true,
                                selection: true,
                                zoom: true,
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: true,
                                customIcons: [] // Пустой массив для дополнительных кнопок
                            },
                        }
                    },
                    xaxis: {
                        categories: data.attendance.map(entry => entry.visit_date)
                    },
                    title: {
                        text: 'Посещаемость за текущий месяц'
                    }
                };

                window.chart = new ApexCharts(document.querySelector("#candle"), options);
                window.chart.render();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Ошибка при загрузке данных: ' + textStatus, errorThrown);
            }
        });
    }

    // Обновляем данные при загрузке страницы
    updateAdminData();

    // Устанавливаем интервал для обновления данных
    setInterval(updateAdminData, 60000); // Каждую минуту
});
