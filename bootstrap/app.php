<?php

use App\Database\Models\Department;
use App\Database\Models\Evidence;
use App\Database\Models\User;
use App\Database\Repositories\Implementations\DepartmentRepository;
use App\Database\Repositories\Implementations\EvidenceRepository;
use App\Database\Repositories\Implementations\UserRepository;
use App\Services\Implementations\AuthService;
use App\Services\Implementations\DepartmentService;
use App\Services\Implementations\EvidenceService;
use App\Services\Interfaces\EvidenceServiceInterface;
use Core\Container;
use Core\App;
use App\Database\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Database\Repositories\Interfaces\EvidenceRepositoryInterface;
use App\Database\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Implementations\UserService;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\DepartmentServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Configs\Database\Implementation\MySqlDatabase;
use Configs\Database\Interfaces\DatabaseInterface;
use ErrorHandlers\UserErrorHandler;

$container = new Container();

$container->bind(DatabaseInterface::class, function () {
    return new MySqlDatabase();
});

$container->bind(DepartmentRepositoryInterface::class, function ($container) {
    return new DepartmentRepository($container->resolve(DatabaseInterface::class));
});

$container->bind(UserRepositoryInterface::class, function ($container) {
    return new UserRepository($container->resolve(DatabaseInterface::class));
});

$container->bind(EvidenceRepositoryInterface::class, function ($container) {
    return new EvidenceRepository($container->resolve(DatabaseInterface::class));
});

$container->bind(AuthServiceInterface::class, function ($container) {
    return new AuthService($container->resolve(User::class), 
                            $container->resolve(UserRepositoryInterface::class), 
                            $container->resolve(UserErrorHandler::class));
});

$container->bind(UserServiceInterface::class, function ($container) {
    return new UserService($container->resolve(User::class),
                            $container->resolve(UserRepositoryInterface::class),
                            $container->resolve(UserErrorHandler::class));
});

$container->bind(DepartmentServiceInterface::class, function ($container) {
    return new DepartmentService($container->resolve(Department::class),
                                $container->resolve(DepartmentRepositoryInterface::class));
});

$container->bind(EvidenceServiceInterface::class, function ($container) {
    return new EvidenceService($container->resolve(Evidence::class),
                                $container->resolve(EvidenceRepositoryInterface::class));
});

App::setContainer($container);