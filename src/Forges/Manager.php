<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Forges;

use DeGraciaMathieu\LaravelManagerGenerator\Crucible;
use DeGraciaMathieu\LaravelManagerGenerator\Templates;
use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Forge;

class Manager implements Forge
{
    public function __construct(Crucible $crucible)
    {
        $this->crucible = $crucible;
    }

    public function forge(array $parameters)
    {
        list($driverSubsets, $defaultDriver) = $this->prepareDrivers($parameters);

        $this->crucible->create(new Templates\Classes\Manager($parameters['name'], $driverSubsets, $defaultDriver));
    }

    protected function prepareDrivers(array $parameters) :array
    {
        $drivers = explode(',', $parameters['drivers']);

        return [
            $this->prepareDriverSubsets($drivers),
            $this->getDefaultDriver($drivers, $parameters),
        ];
    }

    protected function prepareDriverSubsets(array $drivers) :array
    {
        return array_map(function($driver) {

            $driver = StringParser::sanitize($driver);

            return $this->crucible->make(new Templates\Subsets\Driver($driver));

        }, $drivers);
    }

    protected function getDefaultDriver(array $drivers, array $parameters) :string
    {
        return $parameters['default_driver'] ? $parameters['default_driver'] : $drivers[0];
    }
}
