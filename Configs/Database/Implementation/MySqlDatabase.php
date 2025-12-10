<?php

namespace Configs\Database\Implementation;

use PDO;
use PDOException;
use Configs\Database\Interfaces\MySqlDatabaseInterface;

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