FROM php:7.4-apache

RUN apt-get update && \
    apt-get install -y libpq-dev

RUN docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html

COPY . .

EXPOSE 80
