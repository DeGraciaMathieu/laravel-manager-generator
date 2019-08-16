<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates;

use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class DriverClass implements Template
{
    /**
     * @var string $namespace
     */
    public $namespace = 'Drivers';

    /**
     * @var string $sufixName
     */
    public $sufixName = null;

    /**
     * @var string $stub
     */
    public $stub = 'class_driver.stub';

    /**
     * @var string $path
     */
    public $path = 'Drivers';

    /**
     * it's just the constructor
     * @param array $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get template name.
     * @return string
     */
    public function getName() :string
    {
        return StringParser::pascalCase($this->name);
    }

    /**
     * @inheritdoc
     */
    public function getNamespace() :string
    {
        return $this->namespace;
    }

    /**
     * Returns the list of layers.
     * @return array
     */
    public function layers() :array
    {
        return [
            new Layer('{{class_name}}', $this->getName()),
        ];
    }
}
