#!/bin/sh

php artisan key:generate
php artisan migrate:fresh --seed
#php artisan serve --host=0.0.0.0 --port=80
php-fpm

