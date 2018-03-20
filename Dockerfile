# Build javascript dependencies.
FROM node:8-alpine
RUN apk add --no-cache libpng-dev jpeg-dev autoconf automake libtool g++ file nasm make ncurses \
  && mkdir /app

COPY package.json /app
COPY yarn.lock /app
RUN cd /app && yarn install

COPY webpack.mix.js /app
COPY resources/assets /app/resources/assets
RUN cd /app && yarn run production

# Build php dependencies.
FROM composer
COPY . /app
RUN composer install --no-dev -o \
    && rm -rf ./public/hot \
    && find ./vendor -name tests -exec rm -rf {} + \
    && find ./vendor -name Tests -exec rm -rf {} +

# Build application server.
FROM php:7.2-fpm-alpine
ENTRYPOINT ["/entrypoint.sh"]
RUN apk add --no-cache --virtual .build-deps autoconf make g++ sqlite-dev zlib-dev pcre-dev py-pip \
    && apk --no-cache add \
        sqlite \
        zlib \
        nginx \
    && rm /etc/nginx/conf.d/default.conf \
    && docker-php-ext-install zip \
    && docker-php-ext-enable opcache \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && pip install dumb-init \
    && apk del .build-deps \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

COPY ./resources/docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
COPY ./resources/docker/nginx.conf /etc/nginx/nginx.conf
COPY ./resources/docker/conf.d/site.conf /etc/nginx/conf.d/srl.conf
COPY ./resources/docker/www-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY --from=1 /app /var/www/html
COPY --from=0 /app/public /var/www/html/public
