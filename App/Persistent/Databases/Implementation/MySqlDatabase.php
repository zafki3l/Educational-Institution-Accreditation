<?php

namespace App\Persistent\Databases\Implementation;

use App\Persistent\Databases\Interfaces\MySqlDatabaseInterface;
use PDO;
use PDOException;

class MySqlDatabase implements MySqlDatabaseInterface
{
    public function connect(): PDO
    {
        try {
            $dsn = "mysql:host={$_ENV['DB_SERVER']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']};charset=UTF8";
            
            return new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        } catch (PDOException $e) {
            throw $e;
        }
    }
}