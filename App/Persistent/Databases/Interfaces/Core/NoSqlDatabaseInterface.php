<?php

namespace App\Persistent\Databases\Interfaces\Core;

interface NoSqlDatabaseInterface
{
    public function connect(): mixed;   
}