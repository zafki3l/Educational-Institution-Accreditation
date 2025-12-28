<?php

namespace App\Persistent\Databases\Interfaces\Core;

interface DatabaseInterface
{
    public function connect(): mixed;
}