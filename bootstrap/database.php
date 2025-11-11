<?php

use Configs\Database\Implementation\MySqlDatabase;
use Configs\Database\Interfaces\DatabaseInterface;

$container->bind(DatabaseInterface::class, function () {
    return new MySqlDatabase();
});