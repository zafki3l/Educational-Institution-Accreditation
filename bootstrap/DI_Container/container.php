<?php

use Core\App;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();

$builder->useAutowiring(true);
$builder->useAttributes(true);

$builder->addDefinitions(__DIR__ . '/database.php');
$builder->addDefinitions(__DIR__ . '/repositories.php');
$builder->addDefinitions(__DIR__ . '/validations.php');
$builder->addDefinitions(__DIR__ . '/services.php');

$container = $builder->build();

App::setContainer($container);