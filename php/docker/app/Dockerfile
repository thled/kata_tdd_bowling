FROM php:7.4-fpm-alpine3.12

ENV PATH="/home/phpuser/.composer/vendor/bin:${PATH}"

# install utilities
RUN apk add --no-cache \
    php7-dev \
    g++ \
    make \
    # create user
    && adduser -D -g '' phpuser

# install xdebug from pecl
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    # deactivate xdebug as default
    && echo "" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && chown -R phpuser $(pecl config-get php_dir)

USER phpuser

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# install tools from composer
RUN composer global require \
    friendsofphp/php-cs-fixer \
    phpstan/phpstan \
    phpstan/phpstan-strict-rules \
    phpstan/phpstan-phpunit \
    phpstan/phpstan-deprecation-rules \
    ergebnis/phpstan-rules \
    spatie/phpunit-watcher \
    infection/infection 

WORKDIR /usr/src/app
