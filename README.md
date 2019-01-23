## Laravel Eclipse

Laravel Eclipse is a admin package for laravel that allows you to create models, edit the structure of those models, 
and preform crucfunctionality on those models without writing a line of code.

##Installation

After you have installed a new laravel application run the following command in your root directory

'''
composer require bbarron/laravel-eclipse
'''

Once that is done publish all of the packages assets with the following command

'''
php artisan vendor:publish
'''

Select the package bbarron/laravel-eclipse from the dropdown menu

Then go into you .env file and fill out your database information. 
It is very important you do this before the next step.

'''
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xxxxxx
DB_USERNAME=xxxxxx
DB_PASSWORD=xxxxxx
'''

Lastly, run the following command which will configure your date base and create a default user for you to login as.

'''
php artisan eclipse:install
'''

If at any point in this insatllation you get a permision denied message you can cd into the root of your project and run 

'''
sudo chmod -R 777 *
'''

and that should fix the problem.

Now you can go to localhost/admin/login and login with the credintials displayed on your terminal after running the eclipse install command 