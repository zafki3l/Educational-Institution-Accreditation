<?php

namespace Configs\Database\Interfaces\Core;

interface NoSqlDatabaseInterface
{
    public function connect(): mixed;   
}