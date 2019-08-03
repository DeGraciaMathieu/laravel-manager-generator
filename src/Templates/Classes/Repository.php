<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates\Classes;

use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Repository implements Template
{
    /**
     * @inheritdoc
     * @var string $namespace
     */
    public $namespace = 'Contracts';

    /**
     * @inheritdoc
     * @var string $sufixName
     */
    public $sufixName = null;

    /**
     * @inheritdoc
     * @var string $stub
     */
    public $stub = 'class_repository.stub';

    /**
     * @inheritdoc
     * @var string $path
     */
    public $path = null;

    /**
     * Get template name.
     * @return string
     */
    public function getName() :string
    {
        return 'Repository';
    }

    /**
     * Returns the list of layers.
     * @return array
     */
    public function layers()
    {
        return [
            new Layer('{{class_name}}', $this->getName()),
        ];
    }
}
