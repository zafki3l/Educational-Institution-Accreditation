<?php

use Configs\Database\Implementation\MongoDatabase;
use Configs\Database\Implementation\MySqlDatabase;
use Configs\Database\Interfaces\Core\DatabaseInterface;
use Configs\Database\Interfaces\Core\NoSqlDatabaseInterface;

use function DI\autowire;

return [
    DatabaseInterface::class => autowire(MySqlDatabase::class),
    NoSqlDatabaseInterface::class => autowire(MongoDatabase::class)
];