<?php
namespace DeGraciaMathieu\Riddler\Tests;

use PHPUnit\Framework\TestCase;
use DeGraciaMathieu\LaravelManagerGenerator\PaintRoller\Layer;

class LayerTests extends TestCase
{
    /** 
     * @test
     */
    public function make()
    {
        $layer = new Layer('identifier', 'value');

        $this->assertEquals($layer->getIdentifier(), 'identifier');
        $this->assertEquals($layer->getValue(), 'value');
    }
}
