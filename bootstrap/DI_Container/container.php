<?php

use Core\App;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();

$builder->useAutowiring(true);
$builder->useAttributes(true);

$builder->addDefinitions(__DIR__ . '/database.php');
$builder->addDefinitions(__DIR__ . '/repository.php');
$builder->addDefinitions(__DIR__ . '/facades.php');
$builder->addDefinitions(__DIR__ . '/business.php');

$container = $builder->build();

App::setContainer($container);