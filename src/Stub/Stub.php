<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Stub;

class Stub
{
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent() :string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
