# Laravel Resource Manager

Laravel Resource Manager is a admin package for laravel that allows you to create models, edit the structure of those models,
and preform crud functionality on those models without writing a line of code


### Installation

Laravel Eclipse requires [Php Laravel](https://laravel.org/) v5+ to run.

Create a new Laravel Application

```sh
$ composer create-project laravel/laravel LaravelResourceManagerDemo

$ cd LaravelResourceManagerDemo

$ composer require bbarron/laravel-resource-manager
```
While this is install go to you .env file and fill in you database information

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xxxxxx
DB_USERNAME=xxxxxx
DB_PASSWORD=xxxxxx
```

Select Barron\LaravelResourceManager\LaravelResourceManagerServiceProvider from the drop down menu.

```sh
$ php artisan vendor:publish

 Which provider or tags files would you like to publish?:
  [0 ] Publish files from all providers and tags listed below
  [1 ] Provider: Barron\LaravelResourceManager\LaravelResourceManagerServiceProvider


```

Make sure you have your .env file setup before doing this next step. If not the installation script will throw an error.


Next run
```sh
$ php artisan resource-manager:install
```

After this is done installing a username and password will be printed out onto your terminal window. Go to localhost/admin/login to get started
