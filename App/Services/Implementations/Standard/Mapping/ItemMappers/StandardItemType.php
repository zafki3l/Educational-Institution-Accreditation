<?php

namespace App\Services\Implementations\Standard\Mapping\ItemMappers;

enum StandardItemType: string
{
    case BASE = 'base';
    case WITH_DEPARTMENT = 'with_department';
}