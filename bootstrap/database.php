<?php

use Configs\Database\Implementation\MySqlDatabaseSingleton;
use Configs\Database\Interfaces\DatabaseInterface;

$container->bind(DatabaseInterface::class, function () {
    return new MySqlDatabaseSingleton();
});