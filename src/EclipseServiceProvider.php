<?php

namespace Barron\Eclipse;


use Illuminate\Support\ServiceProvider;
use Barron\Eclipse\InstallCommand;

class EclipseServiceProvider extends ServiceProvider
{
  protected $commands = [
    'Barron\Eclipse\InstallCommand'
  ];


  public function boot()
  {
  //  $this->loadRoutesFrom(__DIR__.'/routes/web.php');
   // $this->loadViewsFrom(__DIR__.'/views', 'Eclipse');
    $this->publishes([__DIR__.'/views' => resource_path('/views')]);


  }

  public function register()
  {
    $this->commands($this->commands);
  } 
}
