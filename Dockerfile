#TODO run npm run production

#TODO run composer install

FROM php:7.1-fpm-alpine
ENV DEPS "autoconf make g++ sqlite-dev zlib-dev pcre-dev"
RUN apk -U add $DEPS \
        sqlite \
        zlib \
    && docker-php-ext-install mbstring pdo pdo_sqlite opcache zip \
    && apk del $DEPS \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*