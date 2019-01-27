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
        $this->publishAssets();
        $this->makeModels();
        $this->createStorageLink();
        $this->publishControllers();
        $this->publishMiddleware();
        $this->publishKernel();
        $this->publishRoutes();
        $this->createDefaultUser();
    }
    public function publishAssets()
    {
        $this->call('vendor:publish', ['--provider' => BarronServiceProvider::class]);
        
        $this->info('Public assets successfully published...');
    }
    
    public function createStorageLink()
    {
        Artisan::call('storage:link');
        $this->info("Storage link successfully generated...");
    }
    public function createDefaultUser()
    {   
        $name = $this->ask('Enter your name...');
        $email = $this->ask('Enter you email address...');
        $password = $this->ask('Enter a passsword for your account...');
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->IsAdmin = 1;
        $user->password = Hash::make($password);
        $user->image = "";
        $user->save();
        $this->info('Your accont has been created....');
        $this->info('Go to localhost/admin/login to get started!');
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
        $this->info('Users table successfully created...');
        //create models table
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('tableName');
            $table->boolean('apiAccess')->default('0');
        });
        $this->info('Models table successfully created...');
        //create images table
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('timeStamp');
            $table->string('fileName');
            $table->string('url');
            $table->string('parent');
        });
        $this->info('Images table successfully created...');
        
        //create folders table
        Schema::create('folders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('parent');
            $table->string('unique_id');
            $table->string('name');
        });
        
        $this->info('Folders table successfully created...');
    }
    public function makeModels()
    {
        //make users model
        $params = ['name' => 'User'];
        Artisan::call('make:model', $params);
        $this->info('User Model successfully created...');
        
        //make users model
        $params = ['name' => 'Models'];
        Artisan::call('make:model', $params);
        $this->info('Models Model successfully created...');
        
        //make users model
        $params = ['name' => 'Image'];
        Artisan::call('make:model', $params);
        $this->info('Image Model successfully created...');
        
        //make users model
        $params = ['name' => 'Folder'];
        Artisan::call('make:model', $params);
        $this->info('Folder Model successfully created...');
    }
    public function publishControllers()
    {
        // publish controllers
        foreach ($this->EclipseControllers as $key => $value) {
            copy(__DIR__.'/'.$key,
            base_path('/app/Http/Controllers/'.$value));
        }
       $this->info('Eclipse Controllers copied into App/Http/Controllers...');
    }
    public function publishMiddleware()
    {
        //publish admin middleware file
        copy(__DIR__.'/Http/Middleware/IsAdmin.php',
        base_path('app/Http/Middleware/IsAdmin.php'));
       $this->info('Admin Middleware copied into App/Http/Middleware...');
    }
    public function publishKernel()
    {
        //publish kernel file
        copy(__DIR__.'/Http/Kernel.php',
        base_path('app/Http/Kernel.php'));
        $this->info('App/Http/Kernal.php successfully updated...');
    }
    public function publishRoutes()
    {
        //publish web.php file
        copy(__DIR__.'/routes/web.php',
        base_path('routes/web.php'));
        $this->info('Routes successfully copied into Routes/web.php...');
    }
}
