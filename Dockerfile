FROM php:7.3-cli

WORKDIR /opt/app
VOLUME ./ /opt/app

RUN php composer.phar install
RUN php -S localhost:8000