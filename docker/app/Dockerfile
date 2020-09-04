FROM php:7.4.10-fpm-alpine3.12

RUN mkdir -p /.composer && chown 1000 /.composer \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /usr/src/app
