#!/usr/bin/dumb-init /bin/sh
mkdir -p /run/nginx
/usr/sbin/nginx
chown www-data:www-data /var/www/html/storage -R
/usr/local/sbin/php-fpm