# Laravel Eclipse 

Laravel Eclipse is a admin package for laravel that allows you to create models, edit the structure of those models, 
and preform crud functionality on those models without writing a line of code


### Installation

Laravel Eclipse requires [Php Laravel](https://laravel.org/) v5+ to run.

Create a new Laravel Application

```sh
$ composer create-project laravel/laravel LaravelEclipse

$ cd LaravelEclipse

$ composer require bbarron/laravel-eclipse
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
Also In the .env file add a variable called stylesheet and set it to either light, or dark
This is used to change which stylesheet is being used and allow for easy changing of themes.

```sh
stylesheet=light
```

Make sure you have your .env file setup before doing this next step. If not the installation script will throw an error. Once compser is done installing the package run the following two commands 

Select Barron\Eclipse\EclipseServiceProvider from the drop down menu.
```sh
$ php artisan vendor publish

 Which provider or tags files would you like to publish?:
  [0 ] Publish files from all providers and tags listed below
  [1 ] Provider: Barron\Eclipse\EclipseServiceProvider


```

Next run
```sh
$ php artisan eclipse:install
```

After this is done installing a username and password will be printed out onto your terminal window. Go to localhost/admin/login to get started 

