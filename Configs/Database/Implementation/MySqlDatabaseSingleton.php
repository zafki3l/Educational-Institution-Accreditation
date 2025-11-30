<?php

namespace Configs\Database\Implementation;

use PDO;
use PDOException;
use Configs\Database\Interfaces\DatabaseInterface;

class MySqlDatabaseSingleton implements DatabaseInterface
{
    private static ?PDO $conn = null;

    public function connect(): PDO
    {
        try {
            $dsn = 'mysql:host=' . $_ENV['DB_SERVER'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';charset=UTF8';
            
            return self::getInstance($dsn);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    private static function getInstance($dsn)
    {
        if (self::$conn === null) {
            self::$conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        }

        return self::$conn;
    }

    // prevents someone clone or serialize instance
    private function __clone() {}
    private function __wakeup() {}
}