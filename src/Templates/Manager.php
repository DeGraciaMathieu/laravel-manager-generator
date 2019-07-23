<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates;

use DeGraciaMathieu\LaravelManagerGenerator\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Manager extends AbstractTemplate implements Template
{
    protected $properties = [
        'namespace' => null,
        'sufixName' => 'Manager.php',
        'stub' => 'Manager.stub',
        'path' => null,
    ];

    public function layers()
    {
        return [
            new Layer('{{namespace}}', $this->namespace()),
            new Layer('{{class}}', 'Manager'),
        ];
    } 
}
