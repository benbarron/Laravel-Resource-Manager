<?php

namespace Barron\Eclipse;


use Illuminate\Support\ServiceProvider;
use Barron\Eclipse\InstallCommand;

class EclipseServiceProvider extends ServiceProvider
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
