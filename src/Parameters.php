<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

class Parameters
{
    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    public function getManagerName()
    {
        return $this->properties['manager_name'] ?: null;
    }

    public function getBasePath()
    {
        return $this->properties['base_path'] ?: null;
    }

    public function getBaseNamespace()
    {
        return $this->properties['base_namespace'] ?: null;
    }        
}
