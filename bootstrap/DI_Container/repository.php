<?php

use App\Persistent\Repositories\Sql\Implementations\User\MySqlUserRepository;
use App\Persistent\Repositories\Sql\Interfaces\UserRepositoryInterface;

use function DI\autowire;

return [
    UserRepositoryInterface::class => autowire(MySqlUserRepository::class)
];