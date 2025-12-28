<?php

namespace App\Persistent\Databases\Interfaces;

use App\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use PDO;

interface MySqlDatabaseInterface extends DatabaseInterface 
{
    public function connect(): PDO;
}