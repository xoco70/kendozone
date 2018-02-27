FROM php:7.1.14-fpm

WORKDIR /app
COPY . /app

RUN apt-get update -y && apt-get install -y openssl zip unzip git apt-utils nodejs npm \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo mbstring \
    # && composer install \
    #&& php artisan key:generate \
    # && php artisan migrate \
    # && php artisan db:seed \
    # && touch ./resources/assets/less/_main_full/main.less
    && npm install && npm run dev


CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181
