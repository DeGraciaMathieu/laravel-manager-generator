<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Commands;

use Illuminate\Console\Command;
use DeGraciaMathieu\LaravelManagerGenerator\Forges;
use DeGraciaMathieu\LaravelManagerGenerator\Crucible;
use DeGraciaMathieu\LaravelManagerGenerator\Templates;
use DeGraciaMathieu\LaravelManagerGenerator\Parameters;
use DeGraciaMathieu\LaravelManagerGenerator\StringParser;

class ManagerMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:manager {name} {--drivers=} {--default_driver=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new manager class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parameters = $this->getParameters();

        $crucible = new Crucible($parameters);

        $this->createManager($crucible);
        $this->createDrivers($crucible);
        $this->createRepository($crucible);
    }

    /**
     * Get common parameters
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Parameters
     */
    protected function getParameters() :Parameters
    {
        $basePath = StringParser::concatenateForPath([
            config('manager_generator.base_path'),
            StringParser::pascalCase($this->argument('name')),
        ]);

        return new Parameters([
            'base_path' => $basePath,
            'base_namespace' => config('manager_generator.base_namespace'),
        ]);
    }

    /**
     * Create manager file
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Crucible $crucible
     * @return void
     */
    protected function createManager(Crucible $crucible) :void
    {
        $parameters = [
            'name' => $this->argument('name'),
            'drivers' => $this->option('drivers'),
            'default_driver' => $this->option('default_driver'),
        ];

        (new Forges\Manager($crucible))->forge($parameters);
    }

    /**
     * Create drivers files
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Crucible $crucible
     * @return void
     */
    protected function createDrivers(Crucible $crucible) :void
    {
        $parameters = [
            'drivers' => $this->option('drivers'),
        ];

        (new Forges\Drivers($crucible))->forge($parameters);
    }

    /**
     * Create repository file
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Crucible $crucible
     * @return void
     */
    protected function createRepository(Crucible $crucible) :void
    {
        $parameters = [];

        (new Forges\Repository($crucible))->forge($parameters);
    } 
}
