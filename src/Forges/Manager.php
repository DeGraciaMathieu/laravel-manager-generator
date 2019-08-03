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
     * @return void
     */
    public function forge()
    {
        list($driverSubsets, $defaultDriver) = $this->prepareDrivers();

        $this->crucible->create(new Templates\Classes\Manager($this->crucible->parameters->getName(), $driverSubsets, $defaultDriver));
    }

    /**
     * Prepares drivers subsets and default driver 
     * @param  array  $parameters [description]
     * @return [type]             [description]
     */
    protected function prepareDrivers() :array
    {
        return [
            $this->prepareDriverSubsets(),
            $this->getDefaultDriver(),
        ];
    }

    /**
     * Prepares the drivers subsets of a manager
     * @return array
     */
    protected function prepareDriverSubsets() :array
    {
        return array_map(function($driver) {

            $driver = StringParser::sanitize($driver);

            return $this->crucible->make(new Templates\Subsets\Driver($driver));

        }, $this->crucible->parameters->getDrivers());
    }

    /**
     * Just read the method name
     * @param  array  $drivers
     * @return string
     */
    protected function getDefaultDriver() :string
    {
        return $this->crucible->parameters->hasDefaultDriver() 
            ? $this->crucible->parameters->getDefaultDriver() 
            : $this->crucible->parameters->getFirstDriver();
    }
}
