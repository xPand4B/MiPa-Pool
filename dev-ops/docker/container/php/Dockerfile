FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
    curl \
    npm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && npm i -g npm \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /app
