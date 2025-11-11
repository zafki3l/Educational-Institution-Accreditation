<?php

use App\Database\Repositories\Implementations\DepartmentRepository;
use App\Database\Repositories\Implementations\EvidenceRepository;
use App\Database\Repositories\Implementations\UserRepository;
use Core\Container;
use Core\App;
use App\Database\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Database\Repositories\Interfaces\EvidenceRepositoryInterface;
use App\Database\Repositories\Interfaces\UserRepositoryInterface;
use Configs\Database;

$container = new Container();

$container->bind(DepartmentRepositoryInterface::class, function ($container) {
    return new DepartmentRepository($container->resolve(Database::class));
});

$container->bind(UserRepositoryInterface::class, function ($container) {
    return new UserRepository($container->resolve(Database::class));
});

$container->bind(EvidenceRepositoryInterface::class, function ($container) {
    return new EvidenceRepository($container->resolve(Database::class));
});

App::setContainer($container);