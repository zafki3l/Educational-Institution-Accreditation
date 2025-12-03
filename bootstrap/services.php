<?php

use App\Models\Criteria;
use App\Models\Department;
use App\Models\Evidence;
use App\Models\Milestone;
use App\Models\Role;
use App\Models\Standard;
use App\Models\User;
use App\Repositories\Interfaces\CriteriaRepositoryInterface;
use App\Services\Implementations\AuthService;
use App\Services\Implementations\DepartmentService;
use App\Services\Implementations\EvidenceService;
use App\Services\Implementations\StandardService;
use App\Services\Interfaces\EvidenceServiceInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\EvidenceRepositoryInterface;
use App\Repositories\Interfaces\MilestoneRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\StandardRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Implementations\CriteriaService;
use App\Services\Implementations\FileUploadService;
use App\Services\Implementations\LockService;
use App\Services\Implementations\MilestoneService;
use App\Services\Implementations\RoleService;
use App\Services\Implementations\SessionService;
use App\Services\Implementations\UserService;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\DepartmentServiceInterface;
use App\Services\Interfaces\FileUploadServiceInterface;
use App\Services\Interfaces\LockServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\SessionServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Validations\Interfaces\AuthValidatorInterface;
use App\Validations\Interfaces\UserValidatorInterface;

/**
 * Binding Service classes to container
 */

$container->bind(AuthServiceInterface::class, function ($container) {
    return new AuthService($container->resolve(UserRepositoryInterface::class), 
                            $container->resolve(AuthValidatorInterface::class));
});

$container->bind(UserServiceInterface::class, function ($container) {
    return new UserService($container->resolve(UserRepositoryInterface::class),
                            $container->resolve(UserValidatorInterface::class));
});

$container->bind(DepartmentServiceInterface::class, function ($container) {
    return new DepartmentService($container->resolve(DepartmentRepositoryInterface::class));
});

$container->bind(FileUploadServiceInterface::class, function () {
    return new FileUploadService();
});

$container->bind(EvidenceServiceInterface::class, function ($container) {
    return new EvidenceService($container->resolve(EvidenceRepositoryInterface::class),
                                $container->resolve(FileUploadServiceInterface::class));
});

$container->bind(CriteriaServiceInterface::class, function ($container) {
    return new CriteriaService($container->resolve(CriteriaRepositoryInterface::class));
});

$container->bind(StandardServiceInterface::class, function ($container) {
    return new StandardService($container->resolve(StandardRepositoryInterface::class));
});

$container->bind(MilestoneServiceInterface::class, function ($container) {
    return new MilestoneService($container->resolve(MilestoneRepositoryInterface::class));
});

$container->bind(RoleServiceInterface::class, function ($container) {
    return new RoleService($container->resolve(RoleRepositoryInterface::class));
});

$container->bind(SessionServiceInterface::class, function () {
    return new SessionService();
});

$container->bind(LockServiceInterface::class, function () {
    return new LockService();
});