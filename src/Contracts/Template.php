<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Contracts;

interface Template
{
    /**
     * Get template name.
     * @return string
     */
    public function getName() :string;

    /**
     * Get template namespace.
     * @return string
     */
    public function getNamespace() :?string;

    /**
     * Returns the list of layers.
     * @return array
     */
    public function layers() :array;
}
