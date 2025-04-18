<?php

use Illuminate\Database\Capsule\Manager as Capsule;

include __DIR__ . '/../vendor/autoload.php';
$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'tienda_online',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);


$capsule->setAsGlobal();
$capsule->bootEloquent();

