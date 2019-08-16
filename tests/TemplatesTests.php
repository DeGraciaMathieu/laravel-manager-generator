<?php

namespace DeGraciaMathieu\Riddler\Tests;

use PHPUnit\Framework\TestCase;
use DeGraciaMathieu\LaravelManagerGenerator\Templates;

class TemplatesTests extends TestCase
{
    /** 
     * @test
     */
    public function driverClass()
    {
        $expected = [
            'name' => 'Name',
            'namespace' => 'Drivers',
            'sufix_name' => null,
            'stub' => 'class_driver.stub',
            'path' => 'Drivers',
        ];

        $this->handlWithoutTemplate(Templates\DriverClass::class, $expected);
    }

    /** 
     * @test
     */
    public function driverContract()
    {
        $expected = [
            'name' => 'Name',
            'namespace' => 'Contracts',
            'sufix_name' => null,
            'stub' => 'interface_driver.stub',
            'path' => 'Contracts',
        ];

        $this->handlWithoutTemplate(Templates\DriverContract::class, $expected);
    }

    /** 
     * @test
     */
    public function managerClass()
    {
        $expected = [
            'name' => 'Name',
            'namespace' => 'Name',
            'sufix_name' => null,
            'stub' => 'class_manager.stub',
            'path' => null,
        ];

        $template = new Templates\ManagerClass('name', $drivers = [], $defaultDriver = 'defaultDriver');

        $this->handleWithTemplate($template, $expected);
    }

    /** 
     * @test
     */
    public function driverSubset()
    {
        $expected = [
            'name' => 'name',
            'namespace' => null,
            'sufix_name' => null,
            'stub' => 'subset_driver.stub',
            'path' => null,
        ];

        $this->handlWithoutTemplate(Templates\DriverSubset::class, $expected);
    }

    protected function handlWithoutTemplate(string $fullyQualifiedName, array $expected)
    {
        $template = new $fullyQualifiedName('name');

        $this->handleWithTemplate($template, $expected);
    }

    protected function handleWithTemplate($template, array $expected)
    {
        $this->assertEquals($template->getName(), $expected['name']);
        $this->assertEquals($template->getNamespace(), $expected['namespace']);
        $this->assertEquals($template->sufixName, $expected['sufix_name']);
        $this->assertEquals($template->stub, $expected['stub']);
        $this->assertEquals($template->path, $expected['path']);
    }    
}
