<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

use DeGraciaMathieu\LaravelManagerGenerator\StubsService;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Crucible
{
    /**
     * @var \DeGraciaMathieu\LaravelManagerGenerator\Parameters
     */
    protected $parameters;

    /**
     * @var \DeGraciaMathieu\LaravelManagerGenerator\StubsService
     */
    protected $stubsService;

    /**
     * @param \DeGraciaMathieu\LaravelManagerGenerator\Parameters $parameters
     */
    public function __construct(Parameters $parameters)
    {
        $this->parameters = $parameters;
        $this->stubsService = new StubsService;
    }

    /**
     * Makes template without saving
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template $template
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub
     */
    public function make(Template $template) :Stub
    {
        $stub = $this->forge($template);

        return $stub;
    }

    /**
     * Create a template and save this
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template $template
     * @return void
     */
    public function create(Template $template)
    {
        $stub = $this->forge($template);

        $fullPath = $this->getFullPath($template);

        $this->stubsService->save($stub, $fullPath);
    }

    /**
     * Create a template and save this
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub
     */
    protected function forge(Template $template) :Stub
    {
        $stub = $this->stubsService->load($template);
        
        $stub = $this->stubsService->hydrate($stub, $template->layers());

        if (isset($template->namespace)) {
            $this->hydrateNamespaceLayer($stub, $template);
        }

        return $stub;
    }

    protected function hydrateNamespaceLayer($stub, $template)
    {
        $layers = $this->getNamespaceLayer($template);

        $stub = $this->stubsService->hydrate($stub, $layers); 

        return $stub;
    }

    /**
     * Get a layers list to manage namespaces
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @return array
     */
    protected function getNamespaceLayer(Template $template) :array
    {
        $namespace = StringParser::concatenateForNamespace([
            $this->parameters->getBaseNamespace(),
            $template->namespace,
        ]);

        return [
            new Layer('{{namespace}}', $namespace),
        ];
    }    

    /**
     * Get full template path
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @return string
     */
    protected function getFullPath(Template $template) :string
    {
        $path = $this->getPath($template);

        return StringParser::concatenateForPath([
            $path,
            $template->path,
        ]);
    }

    /**
     * Get template path
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template   $template
     * @return string
     */
    protected function getPath(Template $template) :string
    {
        return StringParser::concatenateForPath([
            $this->parameters->getBasePath(),
            $template->getName(),
        ]);        
    }     
}
