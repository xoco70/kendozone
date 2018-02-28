FROM php:7.1.14-fpm
RUN apt-get update -y && apt-get install -y openssl zip unzip git npm \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& docker-php-ext-install pdo pdo_mysql mbstring \
&& docker-php-ext-install zip \
&& apt-get purge --auto-remove -y g++ \
&& apt-get clean \
&& rm -rf /var/lib/apt/lists/* \
&& npm cache clean -f && npm install -g n && n stable

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && touch ./resources/assets/less/_main_full/main.less

# install apcu
RUN pecl install apcu \
    && docker-php-ext-enable apcu

#install Imagemagick & PHP Imagick ext
RUN apt-get update && apt-get install -y \
        libmagickwand-dev --no-install-recommends

RUN pecl install imagick && docker-php-ext-enable imagick

WORKDIR /app
COPY . /app
RUN composer install && php artisan key:generate && php artisan migrate && php artisan db:seed 
RUN npm install && npm run dev
CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181