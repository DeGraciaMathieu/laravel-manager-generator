<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class StubsService
{
    public function __construct()
    {
        $this->paintRollerService = new PaintRollerService;
    }

    public function load(Template $template) :Stub
    {
        $content = file_get_contents(__DIR__ . '/stubs/' . $template->stub());

        return new Stub($content);
    }

    public function hydrate(Stub $stub, Template $template) :Stub
    {
        $stub = $this->paintRollerService->brush($stub, $template->layers());
        
        return $stub;
    } 

    public function save(Stub $stub, Template $template)
    {
        file_put_contents($template->path(), $stub->getContent());
    }
}
