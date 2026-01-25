<?php

namespace App\Infrastructure\Persistent\Databases\Interfaces\Core;

interface NoSqlDatabaseInterface
{
    public function connect(): mixed;   
}