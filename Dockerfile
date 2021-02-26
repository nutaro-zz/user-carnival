FROM php:7.4-apache-buster

RUN apt update -y
RUN apt upgrade -y
RUN apt install git curl libpng-dev libonig-dev libxml2-dev zip unzip php7.3-mysql/stable -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chmod +x /usr/local/bin/composer
RUN docker-php-ext-install pdo pdo_mysql
RUN phpenmod pdo_mysql
RUN chgrp -R www-data /var/www/html/App/
RUN chmod -R 775 /var/www/html/App/storage
RUN a2enmod rewrite

