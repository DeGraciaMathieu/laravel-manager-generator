<?php

namespace DeGraciaMathieu\LaravelManagerGenerator;

require __DIR__ . '/vendor/autoload.php';

# php artisan make:manager Foo --drivers="Mock,Local"

$parameters = [
    'base_path' => null,
    'base_namespace' => 'App\Services',
    'manager_name' => 'foo',
];

$crucible = new Crucible();

dump($crucible->forge(new Templates\Manager($parameters)));
// dump($crucible->forge(new Templates\Repository($parameters)));
// dump($crucible->forge(new Templates\Drivers($parameters)));
// dump($crucible->forge(new Templates\Contracts($parameters)));

