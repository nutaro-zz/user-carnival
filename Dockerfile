FROM php:7.4-apache-buster

RUN apt update -y
RUN apt upgrade -y
RUN apt install git curl libpng-dev libonig-dev libxml2-dev zip unzip -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chmod +x /usr/local/bin/composer
RUN a2enmod rewrite