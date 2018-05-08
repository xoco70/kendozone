<h1 align="center">
<br>
    <img src="https://my.kendozone.com/images/kz-stamp.png" alt="Kendozone">
    <br>
    Kendozone
    <br>
    <h4 align="center">Create tournaments, configure championships, invite competitors, and generate trees</h4>

</h1>



<p align="center">
    <a href="https://scrutinizer-ci.com/g/xoco70/kendozone/?branch=master">
    <img src="https://scrutinizer-ci.com/g/xoco70/kendozone/badges/quality-score.png?b=master" title="Scrutinizer Code Quality">
    <a href="https://travis-ci.org/xoco70/kendozone"><img src="https://travis-ci.org/xoco70/kendozone.svg?branch=master" alt="Build Status" data-canonical-src="https://travis-ci.org/xoco70/kendozone.svg?branch=master" style="max-width:100%;"></a> [![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
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

## Requirements

- PHP 7 or newer
- HTTP server with PHP support (eg: Apache, Nginx, Caddy)
- Composer
- A supported database: MySQL, PostgreSQL or SQLite

## Installation

Clone the repository

```php
$ git clone https://github.com/xoco70/kendozone.git
$ cd kendozone/
$ composer install
$ npm install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate 
$ php artisan db:seed # Seed dummy data
$ touch ./resources/assets/less/_main_full/main.less
$ npm run dev
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

I will not have much time to dedicate to grow Kendozone, I am looking for developers that can help app grow. Please contact me at contact ( at ) kendozone.com if you are interested

- Improve <a href="https://github.com/xoco70/laravel-tournaments">Laravel Tournaments</a> for more generation possibilities
- Progressively migrate all jQuery stuff to VueJS 
- Develop a hybrid app for live scoring
- Clean front-end mess
- Still a lot to optimize, like some n+1 queries
- Create VueJS Unit Tests
- Decouple Backend and Frontend
- Improve Docker support


## Security Vulnerabilities

If you discover a security vulnerability within Kendozone, please send an e-mail to us at contact@kendozone.com. We handle all security vulnerabilities on a case-by-case basis.

