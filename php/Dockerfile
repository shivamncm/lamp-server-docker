FROM php:8.2-fpm
RUN docker-php-ext-insall pdo pdo_mysql mysqli
WORKDIR /var/www/html
RUN php -m
CMD ["php-fpm"]
