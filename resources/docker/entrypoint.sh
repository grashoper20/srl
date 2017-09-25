#!/usr/bin/dumb-init /bin/sh
mkdir -p /run/nginx
/usr/sbin/nginx
chown www-data:www-data /var/www/html/storage -R
php artisan config:cache
php artisan route:cache
/usr/local/sbin/php-fpm