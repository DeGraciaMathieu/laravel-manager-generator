<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates\Contracts;

use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Driver implements Template
{
    protected $properties = [
        'namespace' => '\Contracts',
        'sufixName' => null,
        'stub' => 'manager.stub',
        'path' => '/Contracts/',
    ];

    public function __construct(array $name)
    {
        $this->name = $name;
    }

    public function layers()
    {
        return [
            new Layer('{{interface_name}}', StringParser::pascalCase($this->name)),
        ];
    }
}
