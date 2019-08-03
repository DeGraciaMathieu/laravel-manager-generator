<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates\Subsets;

use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Driver implements Template
{
    public $stub = 'subset_driver.stub';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function layers() :array
    {
        return [
            new Layer('{{function_name}}', StringParser::pascalCase($this->name)),
            new Layer('{{array_key_name}}', StringParser::snakeCase($this->name)),
            new Layer('{{class_name}}', StringParser::pascalCase($this->name)),
        ];
    }
}
