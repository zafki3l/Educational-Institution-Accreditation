<?php

namespace Configs\Database\Interfaces;

use Configs\Database\Interfaces\Core\NoSqlDatabaseInterface;
use MongoDB\Client;

interface MongoDatabaseInterface extends NoSqlDatabaseInterface 
{
    public function connect(): Client;
}