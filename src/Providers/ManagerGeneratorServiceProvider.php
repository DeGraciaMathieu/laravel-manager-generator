<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use DeGraciaMathieu\LaravelManagerGenerator\Commands\ManagerMakeCommand;

class ManagerGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    
    protected $defer = false;
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    
    public function boot()
    {
        $this->publishes([
             __DIR__. '/config/manager_generator.php' => config_path('manager_generator.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            ManagerMakeCommand::class
        );
    }
}