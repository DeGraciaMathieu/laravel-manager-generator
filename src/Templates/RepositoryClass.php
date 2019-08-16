<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates;

use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class RepositoryClass implements Template
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
    public $stub = 'class_repository.stub';

    /**
     * @var string $path
     */
    public $path = null;

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
        return 'Repository';
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
        ];
    }
}
