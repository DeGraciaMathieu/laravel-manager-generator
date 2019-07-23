<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Templates;

use DeGraciaMathieu\LaravelManagerGenerator\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

abstract class AbstractTemplate
{
    /**
     * @param array $parameters
     */
    public function __construct(array $parameters, array $options = [])
    {
        $this->parameters = $parameters;
    }
    
    public function fileName() :string
    {
        return ucfirst(strtolower($this->parameters['manager_name'])) . $this->properties['sufixName'];
    }

    public function namespace() :string
    {
        $baseNamespace = $this->parameters['base_namespace'];

        if (! $this->properties['namespace']) {
            return $baseNamespace . '/' . ucfirst(strtolower($this->properties['namespace']));
        }

        return $baseNamespace;
    }

    # Si on garde ça je te renie.
    public function path()
    {
        if (! is_null($this->parameters['base_path'] && ! is_null($this->properties['path'])) {
            return $this->parameters['base_path'] . '/' . $this->properties['path'] . '/' . $this->fileName();
        }

        if (! is_null($this->parameters['base_path'])) {
            return $this->parameters['base_path'] . '/' . $this->fileName();
        }

        return $this->fileName();
    }

    public function stub()
    {
        return $this->properties['stub'];
    }
}
