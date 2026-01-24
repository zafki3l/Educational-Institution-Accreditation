<?php

use App\Business\Contexts\ActorContextInterface;
use App\Business\Logging\Interfaces\LogServiceInterface;
use App\Infrastructure\Logging\LogService;
use App\Presentation\Http\Contexts\HttpActorContext;

use function DI\autowire;

return [
    ActorContextInterface::class => autowire(HttpActorContext::class),
    LogServiceInterface::class => autowire(LogService::class),
];