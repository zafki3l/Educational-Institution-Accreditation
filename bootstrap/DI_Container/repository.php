<?php

use App\Business\Ports\CriteriaRepositoryInterface;
use App\Business\Ports\DepartmentRepositoryInterface;
use App\Business\Ports\EvidenceRepositoryInterface;
use App\Business\Ports\RoleRepositoryInterface;
use App\Business\Ports\StandardRepositoryInterface;
use App\Business\Ports\UserRepositoryInterface;
use App\Persistent\Repositories\Sql\Criteria\MySqlCriteriaRepository;
use App\Persistent\Repositories\Sql\Department\MySqlDepartmentRepository;
use App\Persistent\Repositories\Sql\Evidence\MySqlEvidenceRepository;
use App\Persistent\Repositories\Sql\Role\MySqlRoleRepository;
use App\Persistent\Repositories\Sql\Standard\MysqlStandardRepository;
use App\Persistent\Repositories\Sql\User\MySqlUserRepository;

use function DI\autowire;

return [
    UserRepositoryInterface::class => autowire(MySqlUserRepository::class),
    EvidenceRepositoryInterface::class => autowire(MySqlEvidenceRepository::class),
    StandardRepositoryInterface::class => autowire(MysqlStandardRepository::class),
    RoleRepositoryInterface::class => autowire(MySqlRoleRepository::class),
    DepartmentRepositoryInterface::class => autowire(MySqlDepartmentRepository::class),
    CriteriaRepositoryInterface::class => autowire(MySqlCriteriaRepository::class)
];