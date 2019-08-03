<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\PaintRoller;

class Layer
{
    public $identifier;
    public $value;

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
