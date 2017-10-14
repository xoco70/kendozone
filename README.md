<h1 align="center">
<br>
<img src="https://raw.githubusercontent.com/xoco70/laravel-tournaments/master/resources/assets/images/logo.png" alt="Laravel Tournaments">
<br>
Laravel Tournaments
<br>
</h1>

<h4 align="center">Create tournaments, configure championships, invite competitors, and generate trees</h4>


<p align="center">
    <a href="https://scrutinizer-ci.com/g/xoco70/laravel-tournaments/?branch=master">
    <img src="https://scrutinizer-ci.com/g/xoco70/kendozone/badges/quality-score.png?b=master" title="Scrutinizer Code Quality">
    <a href="https://travis-ci.org/xoco70/kendozone"><img src="https://travis-ci.org/xoco70/kendozone.svg?branch=master" alt="Build Status" data-canonical-src="https://travis-ci.org/xoco70/laravel-tournaments.svg?branch=master" style="max-width:100%;"></a>    <a href="https://opensource.org/licenses/MIT"><img src="https://camo.githubusercontent.com/28ddbec0801282129302d6a51a9dd09b4c09c438/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f4c6963656e73652d4d49542d627269676874677265656e2e7376673f7374796c653d666c61742d737175617265" alt="License: MIT" data-canonical-src="https://img.shields.io/badge/License-MIT-brightgreen.svg?style=flat-square" style="max-width:100%;"></a>
</p>
<h1 align="center">
<br>
<img src="https://raw.githubusercontent.com/xoco70/laravel-tournaments/master/resources/assets/images/laravel-tournaments.gif" alt="Laravel Tournaments Demo">
</h1>

* [Features](#features)
* [See Demo](#see-demo)
* [Installation](#installation)
* [Limitations](#limitations)
* [Dependencies](#dependencies)
* [Run Tests](#run-tests)

## Features

- Tournament creation and configuration
- Create and configure Championships based on Category 
- Mass Invite or manually add competitors
- Tree Generation( based on <a href="https://github.com/xoco70/laravel-tournaments">Laravel Tournaments</a> )
- Team management
- Documentation Generation : Fight List, Scoresheets 
- Manage Competitors / Clubs / Associations / Federations
- Multilanguage: Translated to 4 languages: English, French, Spanish, Japonese. <a href="https://lokalise.co/signup/9206592359c17cdcafd822.29517217/all/">Help Translating</a>
 
## See Demo

You can check the hosted version <a href="https://my.kendozone.com">here</a>

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

vendor/bin/phpunit

## Limitations

This is a work in progress, and there is a bunch of stuff to achieve.  

I will not have much time to dedicate to grow Kendozone, I am looking for developpers that can help app grow. Please contact me at contact ( at ) kendozone.com if you are interested

- Improve <a href="https://github.com/xoco70/laravel-tournaments">Laravel Tournaments</a> for more generation possibiilities
- Progressively migrate all JQuery stuff to VueJS 
- Develop an hybrid app for live scoring
- Clean front-end mess
- Still a lot to optimize, like some n+1 queries
- Create VueJS Unit Tests




