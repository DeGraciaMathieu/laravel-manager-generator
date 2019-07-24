<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates\Contracts;

use DeGraciaMathieu\LaravelManagerGenerator\Layer;
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
    public $path = 'Contracts';

    /**
     * @param array $name
     */
    public function __construct(array $name)
    {
        $this->name = $name;
    }

    /**
     * Get template name.
     * @return string
     */
    public function getName() :string
    {
        $name = $this->name . $this->sufixName;

        return StringParser::pascalCase($name);
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
