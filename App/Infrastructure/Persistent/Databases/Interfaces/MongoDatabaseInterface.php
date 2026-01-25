<?php

namespace App\Infrastructure\Persistent\Databases\Interfaces;

use App\Infrastructure\Persistent\Databases\Interfaces\Core\NoSqlDatabaseInterface;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;

interface MongoDatabaseInterface extends NoSqlDatabaseInterface 
{
    public function connect(): Client;

    public function getDatabase(): Database;

    public function getCollection(string $collection_name): Collection;
}