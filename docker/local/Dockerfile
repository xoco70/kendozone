FROM php:7.2-fpm
LABEL maintainer="contact@kendozone.com"
LABEL version="1.0.0"
LABEL description="Kendozone is a online tournament webapp coded with PHP / Laravel"

ENV node_version 8.4.0
ENV npm_version 5.7.1
ENV NVM_DIR /.nvm
ENV APP_DIR="/var/www"
ENV APP_PORT="80"
ENV DOCKER_FOLDER="docker/local"

RUN echo "deb http://ftp.de.debian.org/debian stretch main " >> /etc/apt/sources.list \
&& apt-get update -y 
RUN apt-get install -y openssl zip unzip git gcc make automake \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libmagickwand-dev vim --no-install-recommends
RUN apt-get purge --auto-remove -y g++ \
&& apt-get clean \
&& rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install pdo pdo_mysql mbstring zip -j$(nproc) iconv  -j$(nproc) gd

WORKDIR $APP_DIR
COPY . $APP_DIR

RUN mkdir -p $APP_DIR/resources/assets/less/_main_full \
&& touch $APP_DIR/resources/assets/less/_main_full/main.less \
&& touch $APP_DIR/database/sqlite.db \
&& mv $DOCKER_FOLDER/.env.local .env \
&& chown -R www-data:www-data $APP_DIR

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction

RUN mkdir -p $NVM_DIR && chown -R www-data:www-data $NVM_DIR
RUN  curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.8/install.sh | bash \
&& [ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh" \
&& nvm install ${node_version}

ENV NODE_PATH $NVM_DIR/v$node_version/lib/node_modules
ENV PATH $NVM_DIR/versions/node/v$node_version/bin:$PATH

RUN npm install --save-exact imagemin-pngquant@5.0.*
RUN npm install
RUN npm run production
RUN php artisan key:generate
RUN php artisan migrate --seed 
CMD php artisan serve --host=0.0.0.0 --port=$APP_PORT