<?php

use Core\Container;
use Core\App;
use Configs\Database\Implementation\MySqlDatabase;
use Configs\Database\Interfaces\DatabaseInterface;

$container = new Container();

$container->bind(DatabaseInterface::class, function () {
    return new MySqlDatabase();
});

require_once 'repositories.php';

require_once 'services.php';

App::setContainer($container);