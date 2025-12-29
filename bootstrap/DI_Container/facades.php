<?php

use App\Business\Facades\Implementations\UserFacade;
use App\Business\Facades\Interfaces\UserFacadeInterface;

use function DI\autowire;

return [
    UserFacadeInterface::class => autowire(UserFacade::class)
];