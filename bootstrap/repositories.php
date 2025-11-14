<?php

use App\Database\Repositories\Implementations\CriteriaRepository;
use App\Database\Repositories\Implementations\DepartmentRepository;
use App\Database\Repositories\Implementations\EvidenceRepository;
use App\Database\Repositories\Implementations\UserRepository;
use App\Database\Repositories\Interfaces\CriteriaRepositoryInterface;
use App\Database\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Database\Repositories\Interfaces\EvidenceRepositoryInterface;
use App\Database\Repositories\Interfaces\UserRepositoryInterface;
use Configs\Database\Interfaces\DatabaseInterface;

$container->bind(DepartmentRepositoryInterface::class, function ($container) {
    return new DepartmentRepository($container->resolve(DatabaseInterface::class));
});

$container->bind(UserRepositoryInterface::class, function ($container) {
    return new UserRepository($container->resolve(DatabaseInterface::class));
});

$container->bind(EvidenceRepositoryInterface::class, function ($container) {
    return new EvidenceRepository($container->resolve(DatabaseInterface::class));
});

$container->bind(CriteriaRepositoryInterface::class, function ($container) {
    return new CriteriaRepository($container->resolve(DatabaseInterface::class));
});
