<?php

use App\Infrastructure\Persistent\Databases\Implementation\MongoDatabase;
use App\Infrastructure\Persistent\Databases\Implementation\MySqlDatabase;
use App\Infrastructure\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use App\Infrastructure\Persistent\Databases\Interfaces\MongoDatabaseInterface;

use function DI\autowire;

return [
    DatabaseInterface::class => autowire(MySqlDatabase::class),
    MongoDatabaseInterface::class => autowire(MongoDatabase::class)
];