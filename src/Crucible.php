<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

use DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub;
use DeGraciaMathieu\LaravelManagerGenerator\Stub\StubsService;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class Crucible
{
    /**
     * @var \DeGraciaMathieu\LaravelManagerGenerator\Parameters
     */
    public $parameters;

    /**
     * @var \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub\StubsService
     */
    protected $stubsService;

    /**
     * it's just the constructor
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
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub
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

        $file = $this->prepareFile($template);

        $this->stubsService->save($stub, $file);
    }

    /**
     * Create a template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template $template
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub
     */
    protected function forge(Template $template) :Stub
    {
        $stub = $this->stubsService->load($template);
        
        $stub = $this->stubsService->hydrate($stub, $template->layers());

        if ($this->needNamespace($template)) {
            $this->hydrateNamespaceLayer($stub, $template);
        }

        return $stub;
    }

    /**
     * Check if template need namespace
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template $template
     * @return boolean
     */
    protected function needNamespace(Template $template)
    {
        return ! StringParser::startsWith($template->stub, 'subset');
    }

    /**
     * Hydrate namespace
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub $stub
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template $template
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub
     */
    protected function hydrateNamespaceLayer(Stub $stub, Template $template) :Stub
    {
        $layers = $this->getNamespaceLayer($template);

        $stub = $this->stubsService->hydrate($stub, $layers); 

        return $stub;
    }

    /**
     * Get a layers list to manage namespaces
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template $template
     * @return array
     */
    protected function getNamespaceLayer(Template $template) :array
    {
        $namespace = StringParser::concatenateForNamespace([
            $this->parameters->getBaseNamespace(),
            $template->getNamespace(),
        ]);

        return [
            new Layer('{{namespace}}', $namespace),
        ];
    }    

    /**
     * Prepares file from template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template $template
     * @return \DeGraciaMathieu\LaravelManagerGenerator\File
     */
    protected function prepareFile(Template $template) :File
    {
        $name = $template->getName();
        $path = $this->getPath($template);

        return new File($name, $path);
    }

    /**
     * Get template path
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template $template
     * @return string
     */
    protected function getPath(Template $template) :string
    {
        return StringParser::concatenateForPath([
            $this->parameters->getBasePath(),
            $template->path,
        ]);        
    }     
}
