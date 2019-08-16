<?php
namespace DeGraciaMathieu\Riddler\Tests;

use PHPUnit\Framework\TestCase;
use DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\PaintRollerService;

class PaintRollerServiceTests extends TestCase
{
    /** 
     * @test
     */
    public function brush()
    {
        $layers = [
            new Layer('identifier', 'value'),
        ];

        $stub = (new PaintRollerService)->brush(new Stub('identifier'), $layers);

        $this->assertEquals($stub->getContent(), 'value');
    }
}
