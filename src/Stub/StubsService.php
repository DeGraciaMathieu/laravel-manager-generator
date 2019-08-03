<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\Stub;

use DeGraciaMathieu\LaravelManagerGenerator\File;
use DeGraciaMathieu\LaravelManagerGenerator\StringParser;
use DeGraciaMathieu\LaravelManagerGenerator\Contracts\Template;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\PaintRollerService;

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
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub
     */
    public function load(Template $template) :Stub
    {
        $content = file_get_contents(__DIR__ . '/../Templates/stubs/' . $template->stub);

        return new Stub($content);
    }

    /**
     * Hydrate stub with layers
     * @param \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub
     * @param  array  $layers
     * @return \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub
     */
    public function hydrate(Stub $stub, array $layers) :Stub
    {
        $stub = $this->paintRollerService->brush($stub, $layers);
        
        return $stub;
    } 

    /**
     * [save description]
     * @param \DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub $stub
     * @param \DeGraciaMathieu\LaravelManagerGenerator\File $file
     * @return void
     */
    public function save(Stub $stub, File $file)
    {
        $this->prepareSavingFolder($file);

        $fullPathWithExtension = $this->getFullPathWithExtension($file);

        file_put_contents($fullPathWithExtension, $stub->getContent());
    }

    /**
     * Prepare saving folder for stub
     * @param \DeGraciaMathieu\LaravelManagerGenerator\File $file
     * @return void
     */
    protected function prepareSavingFolder(File $file)
    {
        if (is_dir($file->getPath())) {
            return;
        }
        
        mkdir($file->getPath(), 0777, true);
    }

    /**
     * Get full path with extension from file 
     * @param  \DeGraciaMathieu\LaravelManagerGenerator\File $file
     * @return string
     */
    protected function getFullPathWithExtension(File $file)
    {
        $fullPath = StringParser::concatenateForPath([
            $file->getPath(),
            $file->getName(),
        ]);

        return StringParser::addFileExtension($fullPath);
    }
}
