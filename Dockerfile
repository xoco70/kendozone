FROM php:7.1.14-fpm

WORKDIR /app
COPY . /app

RUN apt-get update -y && apt-get install -y openssl zip unzip git npm \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libmagickwand-dev --no-install-recommends \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& docker-php-ext-install pdo pdo_mysql mbstring \
&& docker-php-ext-install zip \
&& docker-php-ext-install -j$(nproc) iconv mcrypt \
&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd \
&& touch ./resources/assets/less/_main_full/main.less \
&& apt-get purge --auto-remove -y g++ \
&& apt-get clean \
&& rm -rf /var/lib/apt/lists/* \
# && pecl install apcu && docker-php-ext-enable apcu \
# && pecl install imagick && docker-php-ext-enable imagick \
&& composer install && php artisan key:generate && php artisan migrate:fresh  --seed \
&& npm cache clean -f && npm install -g n && n stable && npm install cross-env && npm install && npm run dev
CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181