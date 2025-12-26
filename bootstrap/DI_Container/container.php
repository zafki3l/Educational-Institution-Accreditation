<?php

use Core\App;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();

$builder->useAutowiring(true);
$builder->useAttributes(true);

$builder->addDefinitions(__DIR__ . '/database.php');

$container = $builder->build();

App::setContainer($container);