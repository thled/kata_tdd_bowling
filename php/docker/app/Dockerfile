FROM php:8.0.1-cli-alpine3.12

ENV ENV="/home/phpuser/.profile"

# install utilities
RUN apk add --no-cache \
    # needed for watcher (clear-screen)
    ncurses

# install watcher
RUN curl -fLo watcher.tar.xz \
    https://github.com/watchexec/watchexec/releases/download/1.14.1/watchexec-1.14.1-x86_64-unknown-linux-musl.tar.xz \
    && tar -xf watcher.tar.xz \
    && mv watchexec-1.14.1-x86_64-unknown-linux-musl/watchexec /usr/local/bin/

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

# set aliases
RUN echo 'alias test-watch="watchexec -c -w /usr/src/app/tests -w /usr/src/app/src /usr/src/app/vendor/bin/pest"' >> ~/.profile

WORKDIR /usr/src/app
