<?php

namespace Barron\Eclipse;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use App\User;

class InstallCommand extends Command {

    protected $signature = 'eclipse:install';

    protected $description = 'Command description';


    protected $EclipseControllers = [
        'Http/Controllers/AdminController.php' => '/AdminController.php',
        'Http/Controllers/LoginController.php' => '/LoginController.php',
        'Http/Controllers/MediaController.php' => '/MediaController.php',
        'Http/Controllers/ModelController.php' => '/ModelController.php',
        'Http/Controllers/UserController.php' => '/UserController.php',
    ];


    public function __construct() {
        parent::__construct();
    }

    public function handle()
    {
        $this->runMigrations();
        $this->makeModels();
        $this->createStorageLink();
        $this->publishControllers();
        $this->publishMiddleware();
        $this->publishKernel();
        $this->publishRoutes();
        $this->createDefaultUser();
    }

    public function createStorageLink()
    {
        Artisan::call('storage:link');
        echo "Storage link successfully generated \n";
    }

    public function createDefaultUser()
    {
        $user = new User;
        $user->name = "Default User";
        $user->email = "newuser@eclipse.io";
        $user->IsAdmin = 1;
        $user->password = Hash::make('newuser12345');
        $user->image = "";
        $user->save();

        echo "Default User Created.\n\n";
        echo "You can access the login screen at localhost/admin/login \n";
        echo "Use the login info to login in \n\n";
        echo "Username: newuser@eclipse.io \n";
        echo "Password: newuser12345 \n";
    }

    public function runMigrations()
    {
        //create users table
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('image');
            $table->boolean('IsAdmin')->default('0');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        //create models table
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('tableName');
            $table->boolean('apiAccess')->default('0');
        });

        //create images table
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('timeStamp');
            $table->string('fileName');
            $table->string('url');
        });


    }

    public function makeModels()
    {
        //make users model
        $params = ['name' => 'User'];
        Artisan::call('make:model', $params);

        //make users model
        $params = ['name' => 'Models'];
        Artisan::call('make:model', $params);

        //make users model
        $params = ['name' => 'Image'];
        Artisan::call('make:model', $params);

    }

    public function publishControllers()
    {
        // publish controllers
        foreach ($this->EclipseControllers as $key => $value) {
            copy(__DIR__.'/'.$key,
            base_path('/app/Http/Controllers/'.$value));
        }
        echo "Controllers Published \n";
    }

    public function publishMiddleware()
    {
        //publish admin middleware file
        copy(__DIR__.'/Http/Middleware/IsAdmin.php',
        base_path('app/Http/Middleware/IsAdmin.php'));

        echo "Middleware Successfully Published \n";
    }

    public function publishKernel()
    {
        //publish kernel file
        copy(__DIR__.'/Http/Kernel.php',
        base_path('app/Http/Kernel.php'));

        echo "Kernel Successfully Updated \n";
    }

    public function publishRoutes()
    {
        //publish web.php file
        copy(__DIR__.'/routes/web.php',
        base_path('routes/web.php'));

        echo "Routes Successfully Published \n";
    }
}
