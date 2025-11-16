<?php

use App\Database\Models\Criteria;
use App\Database\Models\Department;
use App\Database\Models\Evidence;
use App\Database\Models\Standard;
use App\Database\Models\User;
use App\Database\Repositories\Interfaces\CriteriaRepositoryInterface;
use App\Services\Implementations\AuthService;
use App\Services\Implementations\DepartmentService;
use App\Services\Implementations\EvidenceService;
use App\Services\Implementations\StandardService;
use App\Services\Interfaces\EvidenceServiceInterface;
use App\Database\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Database\Repositories\Interfaces\EvidenceRepositoryInterface;
use App\Database\Repositories\Interfaces\StandardRepositoryInterface;
use App\Database\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Implementations\CriteriaService;
use App\Services\Implementations\UserService;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\DepartmentServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Validations\Interfaces\AuthValidatorInterface;
use App\Validations\Interfaces\UserValidatorInterface;

$container->bind(AuthServiceInterface::class, function ($container) {
    return new AuthService($container->resolve(User::class), 
                            $container->resolve(UserRepositoryInterface::class), 
                            $container->resolve(AuthValidatorInterface::class));
});

$container->bind(UserServiceInterface::class, function ($container) {
    return new UserService($container->resolve(User::class),
                            $container->resolve(UserRepositoryInterface::class),
                            $container->resolve(UserValidatorInterface::class));
});

$container->bind(DepartmentServiceInterface::class, function ($container) {
    return new DepartmentService($container->resolve(Department::class),
                                $container->resolve(DepartmentRepositoryInterface::class));
});

$container->bind(EvidenceServiceInterface::class, function ($container) {
    return new EvidenceService($container->resolve(Evidence::class),
                                $container->resolve(EvidenceRepositoryInterface::class));
});

$container->bind(CriteriaServiceInterface::class, function ($container) {
    return new CriteriaService($container->resolve(Criteria::class),
                                $container->resolve(CriteriaRepositoryInterface::class));
});

$container->bind(StandardServiceInterface::class, function ($container) {
    return new StandardService($container->resolve(Standard::class),
                                $container->resolve(StandardRepositoryInterface::class));
});