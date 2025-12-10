<?php

namespace Configs\Database\Interfaces\Core;

interface DatabaseInterface
{
    public function connect(): mixed;
}