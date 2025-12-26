<?php

use App\Services\Implementations\CriteriaService;
use App\Services\Implementations\MilestoneService;
use App\Services\Implementations\StandardService;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;


use function DI\autowire;

return [
    CriteriaServiceInterface::class => autowire(CriteriaService::class),
    StandardServiceInterface::class => autowire(StandardService::class),
    MilestoneServiceInterface::class => autowire(MilestoneService::class),
];