<?php
namespace DeGraciaMathieu\Riddler\Tests;

use PHPUnit\Framework\TestCase;
use DeGraciaMathieu\LaravelManagerGenerator\File;

class FileTests extends TestCase
{
    /** 
     * @test
     */
    public function make()
    {
        $file = new File('name', 'path');

        $this->assertEquals($file->getName(), 'name');
        $this->assertEquals($file->getPath(), 'path');
    }
}
