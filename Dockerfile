FROM php:7.4-apache-buster

RUN apt update -y
RUN apt upgrade -y
RUN apt install git curl libpng-dev libonig-dev libxml2-dev zip unzip php7.3-mysql/stable -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chmod +x /usr/local/bin/composer
COPY apache2.conf /etc/apache2/sites-available/default.conf
RUN a2dissite 000-default.conf
RUN a2ensite default.conf
RUN a2enmod rewrite
RUN phpenmod pdo_mysql
RUN useradd -ms /bin/bash www -g www-data
COPY --chown=www:www-data . /opt/UserApi
USER www
WORKDIR /opt/UserApi
RUN chmod 775 App/public -R


