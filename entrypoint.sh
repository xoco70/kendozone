#!/bin/sh
php artisan serve --host=0.0.0.0 --port=$APP_PORT &
echo "Waiting for database connection..."
sleep 10
php artisan migrate:fresh --seed

