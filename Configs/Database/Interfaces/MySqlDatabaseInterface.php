<?php

namespace Configs\Database\Interfaces;

use Configs\Database\Interfaces\Core\DatabaseInterface;
use PDO;

interface MySqlDatabaseInterface extends DatabaseInterface 
{
    public function connect(): PDO;
}