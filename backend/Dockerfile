FROM php:8.0-apache

WORKDIR /var/www/html

COPY composer.json .
COPY composer.lock .

RUN apt-get update && \
    apt-get -y install sudo

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get install -y \
        libzip-dev \
        zip \
        git \
		unzip

COPY . .

RUN composer install
RUN a2enmod rewrite