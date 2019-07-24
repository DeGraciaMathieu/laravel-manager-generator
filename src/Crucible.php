<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

use DeGraciaMathieu\LaravelManagerGenerator\StubsService;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Crucible
{
    /**
     * @var \DeGraciaMathieu\LaravelManagerGenerator\StubsService
     */
    protected $stubsService;

    public function __construct()
    {
        $this->stubsService = new StubsService;
    }

    /**
     * Makes template without saving
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Parameters $parameters
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub
     */
    public function make(Template $template, Parameters $parameters) :Stub
    {
        $stub = $this->forge($template, $parameters);

        return $stub;
    }

    /**
     * Create a template and save this
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Parameters $parameters
     * @return void
     */
    public function create(Template $template, Parameters $parameters)
    {
        $stub = $this->forge($template, $parameters);

        $this->stubsService->save($stub, $this->getFullPath($template, $parameters));
    }

    /**
     * Create a template and save this
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Parameters $parameters
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub
     */
    protected function forge(Template $template, Parameters $parameters) :Stub
    {
        $stub = $this->stubsService->load($template);
        
        $stub = $this->stubsService->hydrate($stub, $template->layers());

        if (isset($template->namespace)) {
            $stub = $this->stubsService->hydrate($stub, $this->getNamespaceLayer($template, $parameters)); 
        }

        return $stub;
    }

    /**
     * Get a layers list to manage namespaces
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Parameters $parameters
     * @return array
     */
    protected function getNamespaceLayer(Template $template, Parameters $parameters) :array
    {
        $namespace = StringParser::concatenateForNamespace([
            $parameters->getBaseNamespace(),
            $template->namespace,
        ]);

        return [
            new Layer('{{namespace}}', $namespace),
        ];
    }    

    /**
     * Get full template path
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Parameters $parameters
     * @return string
     */
    protected function getFullPath(Template $template, Parameters $parameters) :string
    {
        $path = $this->getPath($template, $parameters);

        return StringParser::concatenateForPath([
            $path,
            $template->path,
        ]);
    }

    /**
     * Get template path
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Parameters $parameters
     * @return string
     */
    protected function getPath(Template $template, Parameters $parameters) :string
    {
        return StringParser::concatenateForPath([
            $parameters->getBasePath(),
            $template->getName(),
        ]);        
    }     
}
