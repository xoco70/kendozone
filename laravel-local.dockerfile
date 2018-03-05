FROM php:7.1.14-fpm

WORKDIR /app
COPY . /app
COPY ./entrypoint.sh /tmp

RUN touch /app/resources/assets/less/_main_full/main.less \
&& touch /app/database.sqlite \
&& apt-get update -y && apt-get install -y openssl zip unzip git npm \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libmagickwand-dev --no-install-recommends \
        sqlite3 libsqlite3-dev \
&& apt-get purge --auto-remove -y g++ \
&& apt-get clean \
&& rm -rf /var/lib/apt/lists/* \
&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install pdo pdo_mysql mbstring zip -j$(nproc) iconv mcrypt -j$(nproc) gd

RUN  curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.8/install.sh | bash \
&& export NVM_DIR="$HOME/.nvm" \
&& [ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh" # This loads nvm \
&& nvm install node \
&& npm cache clean -f && npm install -g n && n stable && npm install cross-env && npm install && npm run dev \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer install --no-interaction && composer dump-autoload

RUN chown -R www-data:www-data \
        /app/storage \
        /app/bootstrap/cache \
&& chmod 755 /tmp/entrypoint.sh

CMD ["/tmp/entrypoint.sh"]
