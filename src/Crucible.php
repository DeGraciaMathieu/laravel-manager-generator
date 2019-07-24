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

    public function make(Template $template, Parameters $parameters) :Stub
    {
        $stub = $this->forge($template, $parameters);

        return $stub;
    }

    public function create(Template $template, Parameters $parameters)
    {
        $stub = $this->forge($template, $parameters);

        $this->stubsService->save($stub, $this->getFullPath($template, $parameters));
    }

    protected function forge(Template $template, Parameters $parameters) :Stub
    {
        $stub = $this->stubsService->load($template);
        
        $stub = $this->stubsService->hydrate($stub, $template->layers());

        if (isset($template->properties['namespace'])) {
            $stub = $this->stubsService->hydrate($stub, $this->getNamespaceLayer($template, $parameters)); 
        }

        return $stub;
    }

    protected function getNamespaceLayer(Template $template, Parameters $parameters) :array
    {
        $namespace = StringParser::concatenateForNamespace([
            $parameters->getBaseNamespace(),
            $template->properties['namespace'],
        ]);

        return [
            new Layer('{{namespace}}', $namespace),
        ];
    }    

    protected function getFullPath(Template $template, Parameters $parameters) :string
    {
        $path = $this->getPath($template, $parameters);

        return StringParser::concatenateForPath([
            $path,
            $template->properties['path'],
        ]);
    }

    protected function getPath(Template $template, Parameters $parameters) :string
    {
        return StringParser::concatenateForPath([
            $parameters->getBasePath(),
            $template->getName(),
        ]);        
    }     
}
