<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates;

use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class DriverContract implements Template
{
    /**
     * @var string $namespace
     */
    public $namespace = 'Contracts';

    /**
     * @var string $sufixName
     */
    public $sufixName = null;

    /**
     * @var string $stub
     */
    public $stub = 'interface_driver.stub';

    /**
     * @var string $path
     */
    public $path = 'Contracts';

    /**
     * it's just the constructor
     * @param string $name
     * @param array  $drivers
     * @param string  $defaultDriver
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
     * @inheritdoc
     */
    public function layers() :array
    {
        return [
            new Layer('{{class_name}}', $this->getName()),
        ];
    }
}
