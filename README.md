<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Quality Analytics System (QAS)
## About QAS

The Quality Analytics System (QAS) was designed to allow quality analyst the ability to easily score calls in a BPO or any other form customer services setting.

## Features:
* Quality Analyst can quickly records scores for agent.
* Categorization of score and rating are easily changable.
* Agents can instantly see their scores after being graded.
* Agent are able to communicate with analyst on contesting scores and have them corrected real time.
* Easy access to teamleader,Managers and Team performances.

## How To Install

1. In your terminal open the folder you would like to save the app to then run:
```bash
    $ git clone https://github.com/JamaicanKing/glc_qa_app.git
```
2. to download required packages and recreate vendor file run:
```bash
    $ composer install
```
3. copy .env.example and change name to .env then update with database information.
4. run migrations
```bash
    php artisan migrate
```
5. you should be all set, to go live run:
```bash
    php artisan serve
```
