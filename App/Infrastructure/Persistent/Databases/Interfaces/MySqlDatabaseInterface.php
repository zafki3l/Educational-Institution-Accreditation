<?php

namespace App\Infrastructure\Persistent\Databases\Interfaces;

use App\Infrastructure\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use PDO;

interface MySqlDatabaseInterface extends DatabaseInterface 
{
    public function connect(): PDO;
}