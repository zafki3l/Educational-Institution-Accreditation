<?php

namespace App\Infrastructure\Persistent\Databases\Interfaces\Core;

interface DatabaseInterface
{
    public function connect(): mixed;
}