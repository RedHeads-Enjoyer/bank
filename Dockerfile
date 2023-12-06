# Используем официальный образ PHP с поддержкой Apache
FROM php:7.4-apache

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install pdo pdo_mysql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем файлы проекта в рабочую директорию контейнера
COPY . /var/www/html

# Устанавливаем зависимости Composer
RUN cd /var/www/html && composer install

# Указываем Apache, что index.php является точкой входа
RUN sed -i -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Включаем модуль rewrite для Apache
RUN a2enmod rewrite

# Устанавливаем права на запись для хранилища сессий
RUN chown -R www-data:www-data /var/www/html/storage

# Устанавливаем права на запись для файлов конфигурации Laravel
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

# Открываем порт 8000
EXPOSE 8000

# Запускаем Apache при старте контейнера
CMD ["apache2-foreground"]