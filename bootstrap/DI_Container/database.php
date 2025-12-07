<?php

use Configs\Database\Implementation\MySqlDatabase;
use Configs\Database\Interfaces\DatabaseInterface;

use function DI\autowire;

return [
    DatabaseInterface::class => autowire(MySqlDatabase::class)
];