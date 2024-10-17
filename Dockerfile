# Используем официальный образ PHP с Apache
FROM php:8.1-apache

# Установка необходимых пакетов для PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Копируем исходный код проекта в контейнер
COPY . /var/www/html/

# Настраиваем права доступа
RUN chown -R www-data:www-data /var/www/html

# Включаем mod_rewrite для Apache
RUN a2enmod rewrite

# Открываем порт 80
EXPOSE 80
