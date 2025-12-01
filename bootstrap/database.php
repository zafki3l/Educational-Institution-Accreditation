<?php

use Configs\Database\Implementation\MySqlDatabase;
use Configs\Database\Interfaces\DatabaseInterface;

/**
 * Binding Database classes to container
 */

$container->bind(DatabaseInterface::class, function () {
    return new MySqlDatabase();
});