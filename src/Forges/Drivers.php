<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Forges;

use DeGraciaMathieu\LaravelManagerGenerator\Crucible;
use DeGraciaMathieu\LaravelManagerGenerator\Templates;
use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Forge;

class Drivers implements Forge
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
        $drivers = explode(',', $parameters['drivers']);

        array_map(function($driver) {

            $driver = StringParser::sanitize($driver);

            $this->crucible->create(new Templates\Classes\Driver($driver));

        }, $drivers);
    }
}
