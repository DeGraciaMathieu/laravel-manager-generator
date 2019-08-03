<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates\Subsets;

use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Driver implements Template
{
    /**
     * @var string $stub
     */    
    public $stub = 'subset_driver.stub';

    /**
     * it's just the constructor
     * @param array $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getName() :string
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getNamespace() :string
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function layers() :array
    {
        return [
            new Layer('{{function_name}}', StringParser::pascalCase($this->name)),
            new Layer('{{array_key_name}}', StringParser::snakeCase($this->name)),
            new Layer('{{class_name}}', StringParser::pascalCase($this->name)),
        ];
    }
}
