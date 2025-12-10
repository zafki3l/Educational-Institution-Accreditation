<?php

use App\Repositories\Sql\Implementations\CriteriaRepository;
use App\Repositories\Sql\Implementations\DepartmentRepository;
use App\Repositories\Sql\Implementations\EvidenceRepository;
use App\Repositories\Sql\Implementations\MilestoneRepository;
use App\Repositories\Sql\Implementations\RoleRepository;
use App\Repositories\Sql\Implementations\StandardRepository;
use App\Repositories\Sql\Implementations\UserRepository;
use App\Repositories\Sql\Interfaces\CriteriaRepositoryInterface;
use App\Repositories\Sql\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Sql\Interfaces\EvidenceRepositoryInterface;
use App\Repositories\Sql\Interfaces\MilestoneRepositoryInterface;
use App\Repositories\Sql\Interfaces\RoleRepositoryInterface;
use App\Repositories\Sql\Interfaces\StandardRepositoryInterface;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;

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