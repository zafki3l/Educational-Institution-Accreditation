<?php

use App\Services\Implementations\CriteriaService;
use App\Services\Implementations\DepartmentService;
use App\Services\Implementations\MilestoneService;
use App\Services\Implementations\RoleService;
use App\Services\Implementations\StandardService;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\DepartmentServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;


use function DI\autowire;

return [
    DepartmentServiceInterface::class => autowire(DepartmentService::class),
    CriteriaServiceInterface::class => autowire(CriteriaService::class),
    StandardServiceInterface::class => autowire(StandardService::class),
    MilestoneServiceInterface::class => autowire(MilestoneService::class),
    RoleServiceInterface::class => autowire(RoleService::class),
];