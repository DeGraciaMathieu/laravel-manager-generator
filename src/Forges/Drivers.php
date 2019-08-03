<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Forges;

use DeGraciaMathieu\LaravelManagerGenerator\Crucible;
use DeGraciaMathieu\LaravelManagerGenerator\Templates;
use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Forge;

class Drivers implements Forge
{
    public function __construct(Crucible $crucible)
    {
        $this->crucible = $crucible;
    }

    public function forge(array $parameters)
    {
        $drivers = explode(',', $parameters['drivers']);

        array_map(function($driver) {

            $driver = StringParser::sanitize($driver);

            $this->crucible->create(new Templates\Classes\Driver($driver));

        }, $drivers);
    }
}
