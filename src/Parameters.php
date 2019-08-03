<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

class Parameters
{
    /**
     * @var string
     */
    protected $properties;

    /**
     * it's just the constructor
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return mixed
     */
    public function getManagerName()
    {
        return $this->properties['manager_name'] ?: null;
    }

    /**
     * @return mixed
     */
    public function getBasePath()
    {
        return $this->properties['base_path'] ?: null;
    }

    /**
     * @return mixed
     */
    public function getBaseNamespace()
    {
        return $this->properties['base_namespace'] ?: null;
    }        
}
