<?php

use App\Business\Ports\CriteriaRepositoryInterface;
use App\Business\Ports\DepartmentRepositoryInterface;
use App\Business\Ports\EvidenceRepositoryInterface;
use App\Business\Ports\MilestoneRepositoryInterface;
use App\Business\Ports\RoleRepositoryInterface;
use App\Business\Ports\StandardRepositoryInterface;
use App\Business\Ports\UserRepositoryInterface;
use App\Infrastructure\Persistent\Repositories\Sql\MySqlCriteriaRepository;
use App\Infrastructure\Persistent\Repositories\Sql\MySqlDepartmentRepository;
use App\Infrastructure\Persistent\Repositories\Sql\MySqlEvidenceRepository;
use App\Infrastructure\Persistent\Repositories\Sql\MySqlMilestoneRepository;
use App\Infrastructure\Persistent\Repositories\Sql\MySqlRoleRepository;
use App\Infrastructure\Persistent\Repositories\Sql\MysqlStandardRepository;
use App\Infrastructure\Persistent\Repositories\Sql\MySqlUserRepository;

use function DI\autowire;

return [
    UserRepositoryInterface::class => autowire(MySqlUserRepository::class),
    EvidenceRepositoryInterface::class => autowire(MySqlEvidenceRepository::class),
    StandardRepositoryInterface::class => autowire(MysqlStandardRepository::class),
    RoleRepositoryInterface::class => autowire(MySqlRoleRepository::class),
    DepartmentRepositoryInterface::class => autowire(MySqlDepartmentRepository::class),
    CriteriaRepositoryInterface::class => autowire(MySqlCriteriaRepository::class),
    MilestoneRepositoryInterface::class => autowire(MySqlMilestoneRepository::class)
];