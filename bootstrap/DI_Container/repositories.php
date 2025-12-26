<?php

use App\Repositories\NoSql\Implementations\LogRepository;
use App\Repositories\NoSql\Interfaces\LogRepositoryInterface;
use App\Repositories\Sql\Implementations\CriteriaRepository;
use App\Repositories\Sql\Implementations\MilestoneRepository;
use App\Repositories\Sql\Implementations\StandardRepository;
use App\Repositories\Sql\Interfaces\CriteriaRepositoryInterface;
use App\Repositories\Sql\Interfaces\MilestoneRepositoryInterface;
use App\Repositories\Sql\Interfaces\StandardRepositoryInterface;

use function DI\autowire;

return [
    CriteriaRepositoryInterface::class => autowire(CriteriaRepository::class),
    StandardRepositoryInterface::class => autowire(StandardRepository::class),
    MilestoneRepositoryInterface::class => autowire(MilestoneRepository::class),
    LogRepositoryInterface::class => autowire(LogRepository::class)
];