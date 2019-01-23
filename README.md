# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

# About Recursive TODO
>This projects was built with Laravel Lumen 5.7 and provides a recursive todo list.
It's very simple, just 3 tables:
- Todo item: The task itself
- Status: Configurable status
- Status Log: Registers each status change

Each item may have a parent or not. The first level doesn't have parent and by geting a specific item by it's id you can get all status change history and it's children.

## Requeriments
> As Lumen 5.7 requires php 7.1.3 or higher, this project requires it too

- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

## Clone and Install
You can get the repository from https://github.com/xStarman/devsquad-laravel by clicking in "Clone or Download" and Download ZIP file or run $ git clone https://github.com/xStarman/devsquad-laravel.git in a directory you prefer.

With all cloned files you will need to run composer to install dependencies:
$ composer /path/to/cloned/dir install

## Start Server
You can use xampp or something like, but you wold like to use PHP's built in server by running `$ php -S localhost:8000 -t public` into the installation directory




## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
