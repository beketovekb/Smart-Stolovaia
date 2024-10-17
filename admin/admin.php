<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <section class="main">
        <?php include 'admin_menu.html'; ?>
        <div class="general">
            <div class="filters_line">
                <div class="header_admin">
                    <span class="title">Главная страница</span>
                </div>
            </div>
            <div class="cards">
                <div class="card stat">
                    <span class="card_title">Статистика</span>
                    <div class="left_stat">
                        <div class="progress_circle clip-svg">
                            <div class="progress__content">0%</div>
                            <svg width="160" height="160">
                            <defs>
                            <linearGradient id="gradient"
                                x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop stop-color="#FA545B" offset="0"/>
                                <stop stop-color="#F29F3C" offset="1"/>
                            </linearGradient>
                            </defs>
                            <ellipse rx="55" ry="55" cx="60" cy="60" stroke="#2A333F" fill="none" stroke-width="10"></ellipse>
                                <g>
                                <path id="path" stroke-width="10" stroke="url(#gradient)" fill="none" d="">
                                </path>
                                </g>
                            </svg>
                        </div>
                        <div class="rigth_stat">
                            <span class="stat_title">Количество<br> вошедших учеников</span>
                            <div class="info_stat">
                                <span class="enter_people">123</span>
                                <img src="img/triangle_down.svg" alt="">
                                <span class="enter_procent">43,2%</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card about">
                    <div class="about_info">
                        <span class="school_name">Школа-гимназия №22</span>
                        <div class="dir"><span class="school_title">Директор:</span> <span class="dir_name">Сапаров Арслан Хамитович</span></div>
                        <div class="tel"><span class="school_title">Телефон:</span> <span class="tel_number">+7 (7172) 16-22-32</span></div>
                        <div class="adr"><span class="school_title">Адрес</span> <span class="adr_location">Абылай хана 19/2</span></div>
                    </div>
                    <div class="school_img"></div>
                </div>
                <div class="card hbday">
                    <div class="student_bday">
                        <div class="photo_student"></div>
                        <div class="student_inf">
                            <span class="card_title">Поздравляем с днём рождения!</span>
                            <div>
                                <div class="student_name">Саттарханов Олжас Кабиденович</div>
                                <div class="student_class">5 Б класс</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="diagram">
                <div class="card">
                    <span>TEST</span>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>