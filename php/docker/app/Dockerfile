FROM php:8.0.1-cli-alpine3.12

# install utilities
RUN apk add --no-cache \
    # needed for watcher (clear-screen)
    ncurses \
    # install watcher
    && curl -fLo watcher.tar.xz \
    https://github.com/watchexec/watchexec/releases/download/1.14.1/watchexec-1.14.1-x86_64-unknown-linux-musl.tar.xz \
    && tar -xf watcher.tar.xz \
    && mv watchexec-1.14.1-x86_64-unknown-linux-musl/watchexec /usr/local/bin/

# create user
RUN adduser -D -g '' phpuser
USER phpuser

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# install tools from composer
ENV PATH="/home/phpuser/.composer/vendor/bin:${PATH}"
RUN composer global require \
    # linting
    friendsofphp/php-cs-fixer \
    # static analyses
    phpstan/phpstan \
    phpstan/phpstan-strict-rules \
    phpstan/phpstan-phpunit \
    phpstan/phpstan-deprecation-rules \
    ergebnis/phpstan-rules \
    # mutation testing
    infection/infection

# set aliases
ENV ENV="/home/phpuser/.profile"
RUN echo 'echo -e "Welcome! The following aliases exist:\nrun-lint (rl): Lint the code without changing it.\nrun-fmt (rf): Format the code by the linting rules.\nrun-analyse (ra): Analyse the code statically by PHPStan.\nrun-test (rt): Run all tests.\nrun-watch (rw): Watch all tests."' >> ~/.profile \
    && echo 'alias run-lint="php-cs-fixer fix --config=/usr/src/app/.php_cs -vvv --dry-run --allow-risky=yes"' >> ~/.profile \
    && echo 'alias rl=run-lint' >> ~/.profile \
    && echo 'alias run-fmt="php-cs-fixer fix --config=/usr/src/app/.php_cs --allow-risky=yes"' >> ~/.profile \
    && echo 'alias rf=run-fmt' >> ~/.profile \
    && echo 'alias run-analyse="phpstan analyse --configuration /usr/src/app/phpstan.neon"' >> ~/.profile \
    && echo 'alias ra=run-analyse' >> ~/.profile \
    && echo 'alias run-test="/usr/src/app/vendor/bin/pest"' >> ~/.profile \
    && echo 'alias rt=run-test' >> ~/.profile \
    && echo 'alias run-watch="watchexec -c -w /usr/src/app/tests -w /usr/src/app/src /usr/src/app/vendor/bin/pest"' >> ~/.profile \
    && echo 'alias rw=run-watch' >> ~/.profile

WORKDIR /usr/src/app
