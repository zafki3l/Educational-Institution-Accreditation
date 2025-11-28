<?php

namespace Configs\Database\Implementation;

use PDO;
use PDOException;
use Configs\Database\Interfaces\DatabaseInterface;

class MySqlDatabase implements DatabaseInterface
{
    public function connect(): PDO
    {
        try {
            $dsn = 'mysql:host=' . DB_SERVER . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE . ';charset=UTF8';
            
            return new PDO($dsn, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            throw $e;
        }
    }
}