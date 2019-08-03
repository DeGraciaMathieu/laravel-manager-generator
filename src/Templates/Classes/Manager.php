<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates\Classes;

use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Manager implements Template
{
    /**
     * @inheritdoc
     * @var string $namespace
     */
    public $namespace = null;

    /**
     * @inheritdoc
     * @var string $sufixName
     */
    public $sufixName = 'Manager';

    /**
     * @inheritdoc
     * @var string $stub
     */
    public $stub = 'class_manager.stub';

    /**
     * @inheritdoc
     * @var string $path
     */
    public $path = null;

    /**
     * @param string $name
     * @param array  $drivers
     */
    public function __construct(string $name, array $drivers, string $defaultDriver)
    {
        $this->name = $name;
        $this->drivers = $drivers;
        $this->defaultDriver = $defaultDriver;
    }

    public function getName() :string
    {
        $name = $this->name . $this->sufixName;

        return StringParser::pascalCase($name);
    }

    public function layers() :array
    {
        return [
            new Layer('{{class_name}}', $this->getName()),
            new Layer('{{drivers}}', $this->getDrivers()),
            new Layer('{{default_driver}}', $this->defaultDriver),
        ];
    }

    public function getNamespace()
    {
        return StringParser::pascalCase($this->name) . 'Manager';
    }

    protected function getDrivers()
    {
        $content = null;

        foreach ($this->drivers as $stub) {
            $content .= $stub->getContent();
        }

        return $content;
    }
}
