<?php

namespace Barron\LaravelResourceManager;

use Illuminate\Support\ServiceProvider;
use Barron\LaravelResourceManager\InstallCommand;

class LaravelResourceManagerServiceProvider extends ServiceProvider
{
  protected $commands = [
    'Barron\LaravelResourceManager\InstallCommand'
  ];


  public function boot()
  {
    $this->publishes([__DIR__.'/views' => resource_path('/views')]);
    $this->publishes([__DIR__.'/assets' => public_path('/vendor/eclipse')]);
  }

  public function register()
  {
    $this->commands($this->commands);
  }
}
