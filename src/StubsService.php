<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;

class StubsService
{
    /**
     * @var $var \DeGraciaMathieu\LaravelManagerGenerator\PaintRollerService
     */
    protected $paintRollerService;

    /**
     * it's just the constructor
     */
    public function __construct()
    {
        $this->paintRollerService = new PaintRollerService;
    }

    /**
     * Load a stub from a template
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub
     */
    public function load(Template $template) :Stub
    {
        $content = file_get_contents(__DIR__ . '/stubs/' . $template->stub);

        return new Stub($content);
    }

    /**
     * Hydrate stub with layers
     * @param \DeGraciaMathieu\LaravelManagerGenerator\Stub
     * @param  array  $layers
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub
     */
    public function hydrate(Stub $stub, array $layers) :Stub
    {
        $stub = $this->paintRollerService->brush($stub, $layers);
        
        return $stub;
    } 

    /**
     * [save description]
     * @param \DeGraciaMathieu\LaravelManagerGenerator\Stub
     * @param  string $fullPath [description]
     * @return void
     */
    public function save(Stub $stub, string $fullPath)
    {
        $this->prepareSavingFolder($fullPath);

        $fullPathWithExtension = StringParser::addFileExtension($fullPath);

        file_put_contents($fullPathWithExtension, $stub->getContent());
    }

    /**
     * Prepare saving folder for stub
     * @param  string $fullPath
     * @return void
     */
    protected function prepareSavingFolder(string $fullPath)
    {
        if (is_dir($fullPath)) {
            return;
        }
        
        mkdir($fullPath, 0777, true);
    }
}
