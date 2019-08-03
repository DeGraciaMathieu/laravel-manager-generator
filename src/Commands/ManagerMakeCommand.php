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
    protected $signature = 'make:manager';

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
        $name = $this->ask('What is your manager name ?');
        $drivers = $this->ask('Vrite your drivers names separated by a space (ex:local mock foo)');
        $defaultDriver = $this->choice('What is your default driver ?', explode(' ', $drivers));

        $this->creationIsAnActOfSheerWill($name, $drivers, $defaultDriver);

        $this->info('Manager successfully created !');
    }

    protected function creationIsAnActOfSheerWill(string $name, string $drivers, string $defaultDriver)
    {
        $parameters = $this->getParameters($name, $drivers, $defaultDriver);

        $crucible = new Crucible($parameters);

        (new Forges\Manager($crucible))->forge();
        (new Forges\Drivers($crucible))->forge();
        (new Forges\Repository($crucible))->forge();
    }

    /**
     * Get common parameters
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Parameters
     */
    protected function getParameters(string $name, string $drivers, string $defaultDriver) :Parameters
    {
        $basePath = StringParser::concatenateForPath([
            config('manager_generator.base_path'),
            StringParser::pascalCase($name),
        ]);

        return new Parameters([
            'name' => $name,
            'drivers' => $drivers,
            'default_driver' => $defaultDriver,
            'base_path' => $basePath,
            'base_namespace' => config('manager_generator.base_namespace'),
        ]);
    }
}
