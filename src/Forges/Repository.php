<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Forges;

use DeGraciaMathieu\LaravelManagerGenerator\Crucible;
use DeGraciaMathieu\LaravelManagerGenerator\Templates;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Forge;

class Repository implements Forge
{
    public function __construct(Crucible $crucible)
    {
        $this->crucible = $crucible;
    }

    public function forge(array $parameters)
    {
        $this->crucible->create(new Templates\Classes\Repository());
    }
}
