FROM composer
COPY . /app
RUN composer install --no-dev -o \
    && rm -rf ./public/hot \
    && find ./vendor -name tests -exec rm -rf {} + \
    && find ./vendor -name Tests -exec rm -rf {} +

FROM node:8-alpine
COPY . /app
RUN cd /app \
 && yarn install \
 && yarn run production

FROM php:7.2-fpm-alpine
ENTRYPOINT ["/entrypoint.sh"]
ENV DEPS "autoconf make g++ sqlite-dev zlib-dev pcre-dev py-pip"
RUN apk -U add $DEPS \
        sqlite \
        zlib \
        nginx \
    && docker-php-ext-install opcache zip \
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
COPY ./resources/docker/www-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY --from=0 /app /var/www/html
COPY --from=1 /app/public /var/www/html/public
