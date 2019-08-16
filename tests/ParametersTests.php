<?php
namespace DeGraciaMathieu\Riddler\Tests;

use PHPUnit\Framework\TestCase;
use DeGraciaMathieu\LaravelManagerGenerator\Parameters;

class ParametersTests extends TestCase
{
    /** 
     * @test
     */
    public function make()
    {
        $parameters = new Parameters([
            'name' => 'name',
            'drivers' => 'driver1 driver2 driver3',
            'default_driver' => 'driver2',
            'manager_name' => 'manager_name',
            'base_path' => 'base_path',
            'base_namespace' => 'base_namespace',
        ]);

        $this->assertEquals($parameters->getName(), 'name');
        $this->assertEquals($parameters->getDrivers(), ['driver1', 'driver2', 'driver3']);
        $this->assertEquals($parameters->hasDefaultDriver(), 'driver2');
        $this->assertEquals($parameters->getDefaultDriver(), 'driver2');
        $this->assertEquals($parameters->getFirstDriver(), 'driver1');
        $this->assertEquals($parameters->getManagerName(), 'manager_name');
        $this->assertEquals($parameters->getBasePath(), 'base_path');
        $this->assertEquals($parameters->getBaseNamespace(), 'base_namespace');
    }
}
