<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

class Layer
{
    protected $identifier;
    protected $value;

    public function __construct(string $identifier, string $value)
    {
        $this->identifier = $identifier;
        $this->value = $value;
    }

    public function getIdentifier() :string
    {
        return $this->identifier;
    }

    public function getValue() :string
    {
        return $this->value;
    }
}
