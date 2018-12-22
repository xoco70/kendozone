#!/usr/bin/env bash
rm -rf kz-test \
&& git clone https://github.com/xoco70/kendozone.git kz-test \
&& cd kz-test/ \
&& composer install \
&& npm install \
&& cp .env.example .env \
&& php artisan key:generate \
&& php artisan migrate:fresh --seed --database=sqlite \
&& touch ./resources/assets/less/_main_full/main.less \
&& npm run dev \
&& rm -rf kz-test