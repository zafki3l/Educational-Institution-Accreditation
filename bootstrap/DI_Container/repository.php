<?php

use App\Business\Ports\EvidenceRepositoryInterface;
use App\Business\Ports\StandardRepositoryInterface;
use App\Business\Ports\UserRepositoryInterface;
use App\Persistent\Repositories\Sql\Evidence\MySqlEvidenceRepository;
use App\Persistent\Repositories\Sql\Standard\MysqlStandardRepository;
use App\Persistent\Repositories\Sql\User\MySqlUserRepository;

use function DI\autowire;

return [
    UserRepositoryInterface::class => autowire(MySqlUserRepository::class),
    EvidenceRepositoryInterface::class => autowire(MySqlEvidenceRepository::class),
    StandardRepositoryInterface::class => autowire(MysqlStandardRepository::class)
];