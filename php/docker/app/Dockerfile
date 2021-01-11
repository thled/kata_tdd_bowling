FROM php:8.0.1-cli-alpine3.12

# install utilities
# RUN apk add --no-cache \

# create user
RUN adduser -D -g '' phpuser

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
