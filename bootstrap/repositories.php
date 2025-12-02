<?php

use App\Repositories\Implementations\CriteriaRepository;
use App\Repositories\Implementations\DepartmentRepository;
use App\Repositories\Implementations\EvidenceRepository;
use App\Repositories\Implementations\MilestoneRepository;
use App\Repositories\Implementations\RoleRepository;
use App\Repositories\Implementations\StandardRepository;
use App\Repositories\Implementations\UserRepository;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\EvidenceRepositoryInterface;
use App\Repositories\Interfaces\MilestoneRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\StandardRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Configs\Database\Interfaces\DatabaseInterface;

/**
 * Binding Repository classes to container
 */

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

$container->bind(StandardRepositoryInterface::class, function ($container) {
    return new StandardRepository($container->resolve(DatabaseInterface::class));
});

$container->bind(MilestoneRepositoryInterface::class, function ($container) {
    return new MilestoneRepository($container->resolve(DatabaseInterface::class));
});

$container->bind(RoleRepositoryInterface::class, function ($container) {
    return new RoleRepository($container->resolve(DatabaseInterface::class));
});