FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer