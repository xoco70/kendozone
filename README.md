<h1 align="center">
<br>
    <img src="https://raw.githubusercontent.com/xoco70/kendozone/master/resources/assets/images/kz-stamp.png" alt="Kendozone">
    <br>
    Kendozone
    <br>
    <h4 align="center">Create tournaments, configure championships, invite competitors, and generate trees</h4>

</h1>



<p align="center">
    <a href="https://scrutinizer-ci.com/g/xoco70/kendozone/?branch=master">
    <img src="https://scrutinizer-ci.com/g/xoco70/kendozone/badges/quality-score.png?b=master" title="Scrutinizer Code Quality">
    <a href="https://travis-ci.org/xoco70/kendozone"><img src="https://travis-ci.org/xoco70/kendozone.svg?branch=master" alt="Build Status" data-canonical-src="https://travis-ci.org/xoco70/kendozone.svg?branch=master" style="max-width:100%;"></a>
</p>

* [Features](#features)
* [See Demo](#see-demo)
* [Requirements](#requirements)
* [Installation](#installation)
* [Limitations](#limitations)
* [Run Tests](#run-tests)
* [Dependencies](#dependencies)
* [Security Vulnerabilities](security-vulnerabilities)


## Features

- Tournament creation and configuration
- Create and configure Championships based on Category 
- Mass Invite or manually add competitors
- Tree Generation( based on <a href="https://github.com/xoco70/laravel-tournaments">Laravel Tournaments</a> )
- Team management
- Documentation Generation : Fight List, Scoresheets 
- Manage Competitors / Clubs / Associations / Federations
- Multilanguage: Translated to 4 languages: English, French, Spanish, Japanese. <a href="https://lokalise.co/signup/9206592359c17cdcafd822.29517217/all/">Help Translating</a>
 
## See Demo

You can check the hosted version <a href="https://my.kendozone.com">here</a>

You can also try it with docker with the command: 

```bash
docker run -d -p 80:80 --rm --name kz xoco/kendozone:local-1.0.3
```
You can login as root with:

user: superuser@kendozone.dev

pass: superuser@kendozone.dev

> Warning: Dockerized version still not working 100%

## Requirements

- PHP 7 or newer
- MySQL or compatible
- Nginx
- Composer

## Installation

Clone the repository

```bash
git clone https://github.com/xoco70/kendozone.git
cd kendozone/
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate 
php artisan db:seed # Seed dummy data
touch ./resources/assets/less/_main_full/main.less
npm run dev
```

You can login as root with:

user: superuser@kendozone.dev

pass: superuser


## Dependencies: 

To generate PDF, Kendozone use <a href="https://github.com/barryvdh/laravel-snappy">laravel-snappy</a> that use behind the scene <a href="https://wkhtmltopdf.org/">wkhtmltopdf</a>

In order to be able to generate PDF, you must install wkhtmltopdf in your system.

## Run Tests

```php
vendor/bin/phpunit
```

## Limitations

This is a work in progress, and there is a bunch of stuff to achieve.  

There is a current refactoring work in progress:

- <a href="https://github.com/xoco70/kz-front">Front End made with Angular 6 / Boostrap 4</a>
- <a href="https://github.com/xoco70/kz-api">API made with Lumen</a>

I will not have much time to dedicate to grow Kendozone, I am looking for developers that can help app grow. Please contact me at contact ( at ) kendozone.com if you are interested

- Improve <a href="https://github.com/xoco70/laravel-tournaments">Laravel Tournaments</a> for more generation possibilities
- Progressively migrate all jQuery stuff to VueJS 
- Develop a hybrid app for live scoring
- Clean front-end mess
- Still a lot to optimize, like some n+1 queries
- Create VueJS Unit Tests
- Decouple Backend and Frontend
- Improve Docker support

