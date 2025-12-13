<?php

use Configs\Database\Implementation\MongoDatabase;
use Configs\Database\Implementation\MySqlDatabase;
use Configs\Database\Interfaces\Core\DatabaseInterface;
use Configs\Database\Interfaces\MongoDatabaseInterface;

use function DI\autowire;

return [
    DatabaseInterface::class => autowire(MySqlDatabase::class),
    MongoDatabaseInterface::class => autowire(MongoDatabase::class)
];