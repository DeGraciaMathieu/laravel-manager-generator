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

    public function getName()
    {
        return $this->properties['name'] ?: null;
    }

    public function getDrivers()
    {
        return explode(' ', $this->properties['drivers']);
    }    

    public function hasDefaultDriver()
    {
        if (! $this->getDefaultDriver()) {
            return null;
        }

        return $this->properties['default_driver'];
    }

    public function getDefaultDriver()
    {
        return $this->properties['default_driver'];
    }

    public function getFirstDriver()
    {
        $drivers = $this->getDrivers();

        return $drivers[0];
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
