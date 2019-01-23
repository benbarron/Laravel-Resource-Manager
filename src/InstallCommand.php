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

    protected $EclipseCSS = [
        'assets/css/dark.css' => '/dark.css',
        'assets/css/light.css' => '/light.css',
        'assets/css/midnight.css' => '/midnight.css',
        'assets/css/ocean.css' => '/ocean.css',
        'assets/css/main.css' => '/main.css',
    ];

    protected $EclipseJS = [
        'assets/js/app.js' => '/app.js',
        'assets/js/materialize.min.js' => '/materialize.min.js'
    ];

    protected $EclipseIMG = [
        'assets/img/users.jpeg' => '/users.jpeg',
        'assets/img/profile.jpeg' => '/profile.jpeg'
    ];

    protected $EclipseViews = [
        'views/home.blade.php' => '/home.blade.php',

        'views/admin/alerts/messages.blade.php' => '/admin/alerts/messages.blade.php',
        'views/admin/layouts/app.blade.php' => '/admin/layouts/app.blade.php',

        'views/admin/partials/footer.blade.php' => '/admin/partials/footer.blade.php',
        'views/admin/partials/header.blade.php' => '/admin/partials/header.blade.php',
        'views/admin/partials/panels.blade.php' => '/admin/partials/panels.blade.php',
        'views/admin/partials/preload.blade.php' => '/admin/partials/preload.blade.php',
        'views/admin/partials/sidebar.blade.php' => '/admin/partials/sidebar.blade.php',

        'views/admin/browse-models.blade.php' => '/admin/browse-models.blade.php',
        'views/admin/documentation.blade.php' => '/admin/documentation.blade.php',
        'views/admin/edit-model-entry.blade.php' => '/admin/edit-model-entry.blade.php',
        'views/admin/edit-models.blade.php' => '/admin/edit-models.blade.php',
        'views/admin/home.blade.php' => '/admin/home.blade.php',
        'views/admin/login.blade.php' => '/admin/login.blade.php',
        'views/admin/media.blade.php' => '/admin/media.blade.php',
        'views/admin/model-entry.blade.php' => '/admin/model-entry.blade.php',
        'views/admin/models.blade.php' => '/admin/models.blade.php',
        'views/admin/new-model.blade.php' => '/admin/new-model.blade.php',
        'views/admin/new-user.blade.php' => '/admin/new-user.blade.php',
        'views/admin/profile.blade.php' => '/admin/profile.blade.php',
        'views/admin/users.blade.php' => '/admin/users.blade.php',
    ];


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
        echo "Use the login info to login in \n";
        echo "Username: newuser@eclipse.io \n";
        echo "Password: newuser12345 \n";
    }

    public function runMigrations()
    {
        //create users table
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
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
            $table->string('image');
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

    public function publishAssets()
    {

        // publish css
        foreach ($this->EclipseCSS as $key => $value) {
            copy(__DIR__.'/'.$key,
            base_path('public/vendor/eclipse/css'.$value));
        }

        echo "CSS Successfully Published \n";

        // publish javascript
        foreach ($this->EclipseJS as $key => $value) {
            copy(__DIR__.'/'.$key,
            base_path('public/vendor/eclipse/js'.$value));
        }

        echo "JS Successfully Published \n";

        // publish images
        foreach ($this->EclipseIMG as $key => $value) {
            copy(__DIR__.'/'.$key,
            base_path('public/vendor/eclipse/img'.$value));
        }

        echo "Images Successfully Published \n";
    }

    public function publishViews()
    {
        //publish views
        foreach ($this->EclipseViews as $key => $value) {
           copy(__DIR__.'/'.$key,
           base_path('resources/views'.$value));
       }

       echo "Views Successfully Published \n";
    }

    public function publishRoutes()
    {
        //publish web.php file
        copy(__DIR__.'/routes/web.php',
        base_path('routes/web.php'));

        echo "Routes Successfully Published \n";
    }
}
