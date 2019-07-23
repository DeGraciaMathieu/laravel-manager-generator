<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

use DeGraciaMathieu\LaravelManagerGenerator\StubsService;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Crucible
{
    public function __construct()
    {
        $this->stubsService = new StubsService;
    }

    public function forge(Template $template)
    {
        $stub = $this->stubsService->load($template);
        
        $stub = $this->stubsService->hydrate($stub, $template);

        $this->stubsService->save($stub, $template);
    }
}
