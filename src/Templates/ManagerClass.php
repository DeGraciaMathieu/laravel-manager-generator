<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates;

use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class ManagerClass implements Template
{
    public $name = null;

    /**
     * @var string $namespace
     */
    public $namespace = null;

    /**
     * @var string $sufixName
     */
    public $sufixName = null;

    /**
     * @var string $stub
     */
    public $stub = 'class_manager.stub';

    /**
     * @inheritdoc
     * @var string $path
     */
    public $path = null;

    /**
     * it's just the constructor
     * @param string $name
     * @param array  $drivers
     * @param string  $defaultDriver
     */
    public function __construct(string $name, array $drivers, string $defaultDriver)
    {
        $this->name = $name;
        $this->drivers = $drivers;
        $this->defaultDriver = $defaultDriver;
    }

    /**
     * @inheritdoc
     */
    public function getName() :string
    {
        $name = $this->name . $this->sufixName;

        return StringParser::pascalCase($name);
    }

    /**
     * @inheritdoc
     */
    public function getNamespace() :string
    {
        return StringParser::pascalCase($this->name);
    }

    /**
     * @inheritdoc
     */
    public function layers() :array
    {
        return [
            new Layer('{{class_name}}', $this->getName()),
            new Layer('{{drivers}}', $this->getDrivers()),
            new Layer('{{default_driver}}', $this->defaultDriver),
        ];
    }

    /**
     * Merge drivers content
     * @return string
     */
    protected function getDrivers() :string
    {
        $content = null;

        foreach ($this->drivers as $stub) {
            $content .= $stub->getContent();
        }

        return $content;
    }
}
