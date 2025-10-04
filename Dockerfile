FROM composer:2 AS composer

FROM php:8.4-cli-alpine

RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del $PHPIZE_DEPS

RUN { \
  echo "xdebug.mode=debug,develop"; \
  echo "xdebug.client_port=9003"; \
  echo "xdebug.start_with_request=yes"; \
  echo "xdebug.log_level=0"; \
} > /usr/local/etc/php/conf.d/xdebug.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

WORKDIR /app