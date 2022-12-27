#!/bin/bash
set -e

cd /var/www
php artisan config:cache
cd /var/www && php artisan schedule:run >> /dev/null 2>&1

# Install cron job
crontab cronfile

# Remove temporary file
rm cronfile

env >> /var/www/.env
php artisan clear-compiled
php artisan config:clear
php artisan migrate
php-fpm8.1 -D
# Start cron
cron
nginx -g "daemon off;"


