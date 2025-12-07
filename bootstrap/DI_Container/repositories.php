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

use function DI\autowire;

return [
    DepartmentRepositoryInterface::class => autowire(DepartmentRepository::class),
    UserRepositoryInterface::class => autowire(UserRepository::class),
    EvidenceRepositoryInterface::class => autowire(EvidenceRepository::class),
    CriteriaRepositoryInterface::class => autowire(CriteriaRepository::class),
    StandardRepositoryInterface::class => autowire(StandardRepository::class),
    MilestoneRepositoryInterface::class => autowire(MilestoneRepository::class),
    RoleRepositoryInterface::class => autowire(RoleRepository::class)
];