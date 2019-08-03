<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Forges;

use DeGraciaMathieu\LaravelManagerGenerator\Crucible;
use DeGraciaMathieu\LaravelManagerGenerator\Templates;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Forge;

class Repository implements Forge
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
        $this->crucible->create(new Templates\Classes\Repository());
    }
}
