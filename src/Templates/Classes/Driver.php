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
    public $namespace = 'Drivers';

    /**
     * @inheritdoc
     * @var string $sufixName
     */
    public $sufixName = null;

    /**
     * @inheritdoc
     * @var string $stub
     */
    public $stub = 'class_driver.stub';

    /**
     * @inheritdoc
     * @var string $path
     */
    public $path = 'Drivers';

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
        return StringParser::pascalCase($this->name);
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
