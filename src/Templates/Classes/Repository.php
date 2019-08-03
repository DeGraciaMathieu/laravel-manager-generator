<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates\Classes;

use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Repository implements Template
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
