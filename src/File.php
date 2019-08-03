<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

class File
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $path;

    /**
     * it's just the constructor
     * @param string $name
     * @param string $path
     */
    public function __construct(string $name, string $path)
    {
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath() :string
    {
        return $this->path;
    }    
}
