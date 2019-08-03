<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Forges;

use DeGraciaMathieu\LaravelManagerGenerator\Crucible;
use DeGraciaMathieu\LaravelManagerGenerator\Templates;
use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Forge;

class Manager implements Forge
{
    /**
     * it's just the constructor
     * @param \DeGraciaMathieu\LaravelManagerGenerator\Crucible $crucible
     */    
    public function __construct(Crucible $crucible)
    {
        $this->crucible = $crucible;
    }

    /**
     * Forge a template manager
     * @param  array  $parameters
     * @return void
     */
    public function forge(array $parameters)
    {
        list($driverSubsets, $defaultDriver) = $this->prepareDrivers($parameters);

        $this->crucible->create(new Templates\Classes\Manager($parameters['name'], $driverSubsets, $defaultDriver));
    }

    /**
     * Prepares drivers subsets and default driver 
     * @param  array  $parameters [description]
     * @return [type]             [description]
     */
    protected function prepareDrivers(array $parameters) :array
    {
        $drivers = explode(',', $parameters['drivers']);

        return [
            $this->prepareDriverSubsets($drivers),
            $this->getDefaultDriver($drivers, $parameters),
        ];
    }

    /**
     * Prepares the drivers subsets of a manager
     * @param  array  $drivers [description]
     * @return array
     */
    protected function prepareDriverSubsets(array $drivers) :array
    {
        return array_map(function($driver) {

            $driver = StringParser::sanitize($driver);

            return $this->crucible->make(new Templates\Subsets\Driver($driver));

        }, $drivers);
    }

    /**
     * Just read the method name
     * @param  array  $drivers
     * @param  array  $parameters
     * @return string
     */
    protected function getDefaultDriver(array $drivers, array $parameters) :string
    {
        return $parameters['default_driver'] ? $parameters['default_driver'] : $drivers[0];
    }
}
