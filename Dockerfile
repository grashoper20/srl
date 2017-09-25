FROM composer
COPY . /app
RUN composer install --no-dev

FROM node:alpine
COPY . /app
RUN cd /app && yarn install && yarn run production

FROM php:7.1-fpm-alpine
ENTRYPOINT ["/entrypoint.sh"]
ENV DEPS "autoconf make g++ sqlite-dev zlib-dev pcre-dev py-pip"
RUN apk -U add $DEPS \
        sqlite \
        zlib \
        nginx \
    && docker-php-ext-install mbstring pdo pdo_sqlite opcache zip \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && pip install dumb-init \
    && apk del $DEPS \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

COPY ./resources/docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
COPY ./resources/docker/nginx.conf /etc/nginx/nginx.conf
COPY ./resources/docker/conf.d/site.conf /etc/nginx/conf.d/srl.conf
COPY --from=0 /app /var/www/html
COPY --from=1 /app/public /var/www/html/public
