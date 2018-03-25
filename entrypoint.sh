#!/bin/sh

php artisan key:generate
echo "Waiting for database connection..."
sleep 10
php artisan migrate:fresh --seed
#npm run dev
#php artisan serve --host=0.0.0.0 --port=80
php-fpm

