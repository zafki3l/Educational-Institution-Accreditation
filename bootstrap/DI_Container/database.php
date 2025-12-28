<?php

use App\Persistent\Databases\Implementation\MongoDatabase;
use App\Persistent\Databases\Implementation\MySqlDatabase;
use App\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use App\Persistent\Databases\Interfaces\MongoDatabaseInterface;

use function DI\autowire;

return [
    DatabaseInterface::class => autowire(MySqlDatabase::class),
    MongoDatabaseInterface::class => autowire(MongoDatabase::class)
];