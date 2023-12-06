# Используем официальный образ PHP с Apache
FROM php:7.4-apache

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install pdo pdo_mysql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем Node.js и npm
RUN apt-get update && apt-get install -y npm

# Копируем файлы приложения в контейнер
COPY bank /var/www/html

# Устанавливаем зависимости Composer
RUN cd /var/www/html && composer install

# Устанавливаем зависимости npm
RUN cd /var/www/html && npm install

# Генерируем ключ для Laravel
RUN cd /var/www/html && php artisan key:generate

# Указываем Apache, что директория /var/www/html/public - это DocumentRoot
RUN sed -i -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Включаем модуль mod_rewrite для Apache
RUN a2enmod rewrite

# Запускаем Apache
CMD ["apache2-foreground"]
