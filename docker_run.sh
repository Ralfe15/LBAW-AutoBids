#!/bin/bash
set -e

cd /var/www
php artisan config:cache


echo '* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1' > cronfile

# Install cron job
crontab cronfile

# Remove temporary file
rm cronfile

env >> /var/www/.env
php artisan clear-compiled
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan migrate
php-fpm8.1 -D
# Start cron
cron
nginx -g "daemon off;"


