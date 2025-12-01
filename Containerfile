FROM php:8.2-fpm


WORKDIR /var/www/html


COPY app.php /var/www/html 
