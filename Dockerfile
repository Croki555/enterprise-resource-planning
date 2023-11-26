# Используйте образ PHP в качестве базового образа
FROM php:8.1-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Устанавливаем расширения PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Копируем файлы проекта в Docker-контейнер
COPY . /var/www/html

# Устанавливаем зависимости проекта с помощью Composer
RUN composer install

# Назначаем права на директорию хранения сессий и кэша Laravel
RUN chown -R www-data:www-data /var/www/html/storage

# Говорим Docker, какой порт использовать
EXPOSE 8000

# Запускаем веб-сервер PHP
CMD php artisan serve --host=0.0.0.0 --port=8000