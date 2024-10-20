<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора - Библиотека</title>
    <link rel="stylesheet" href="css/style.css">
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
                    <span class="title">Библиотека</span>
                    <a href="" class="blue_btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_78_677)">
                                <path d="M5.09766 10.8789L10 15.7812L14.9023 10.8789" stroke="white" stroke-width="1.5625" stroke-miterlimit="10" stroke-linecap="square"/>
                                <mask id="mask0_78_677" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                                    <path d="M0 1.90735e-06H20V20H0V1.90735e-06Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0_78_677)">
                                    <path d="M10 15.0781V0.78125" stroke="white" stroke-width="1.5625" stroke-miterlimit="10" stroke-linecap="square" stroke-linejoin="round"/>
                                    <path d="M0 19.2188H20" stroke="white" stroke-width="1.5625" stroke-miterlimit="10"/>
                                </g>
                            </g>
                            <defs>
                                <clipPath id="clip0_78_677">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>                            
                        <span>
                            Скачать отчёт
                        </span>                    
                    </a>
                </div>
                <div class="filters space_between">
                    <div class="filters-row">
                        <div class="search-container">
                            <input type="text" class="search-input" placeholder="Поиск...">
                            <button class="search-button"></button>
                        </div>
                        <div class="dropdown" id="dropdown1">
                            <button class="dropbtn">Фильтр по классам               
                            </button>
                            <div class="dropdown-content">
                                <a href="#" onclick="selectClass(event, 'dropdown1')" class="default">Фильтр по классам</a>
                                <a href="#" onclick="selectClass(event, 'dropdown1')">1 класс</a>
                                <a href="#" onclick="selectClass(event, 'dropdown1')">2 класс</a>
                                <a href="#" onclick="selectClass(event, 'dropdown1')">3 класс</a>
                                <a href="#" onclick="selectClass(event, 'dropdown1')">4 класс</a>
                                <a href="#" onclick="selectClass(event, 'dropdown1')">5 класс</a>
                                <a href="#" onclick="selectClass(event, 'dropdown1')">6 класс</a>
                                <a href="#" onclick="selectClass(event, 'dropdown1')">7 класс</a>
                            </div>
                        </div>
                        <div class="card-body "> 
                            <input type="text" class="dropbtn form-control mb-3 flatpickr-no-config flatpickr-input active" placeholder="Фильтр по дате" readonly="readonly">
                        </div>
                    </div>
                    <div class="filter-row">
                        <div class="sorting">
                            <div class="card-body"> 
                                <input type="text" class="form-control flatpickr-range mb-3 flatpickr-input" placeholder="Выберите дату от и до" readonly="readonly">
                            </div>
                            <a href="" class="green_btn">Отфильтровать</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="admin_reports">
                <div class="right_content">
                    <div class="table_titles">
                        <span class="table_lib-name">ФИО</span>
                        <span class="table_lib-godizd">Класс</span>
                        <span class="table_lib-izd">Время посещения</span>
                        <span class="table_lib-janr">Дата посещения</span>
                    </div>
                    <div class="table_list">
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                        <div class="table_line">
                            <span class="table_lib-name_value">Сейсенбаев Максат Дауренович</span>
                            <span class="table_lib-godizd_value red">10 А</span>
                            <span class="table_lib-izd_value">00:00</span>
                            <span class="table_lib-janr_value">14.10.1997</span>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>