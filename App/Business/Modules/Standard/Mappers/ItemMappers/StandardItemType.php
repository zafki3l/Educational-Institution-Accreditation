<?php

namespace App\Business\Modules\Standard\Mappers\ItemMappers;

enum StandardItemType: string
{
    case BASE = 'base';
    case WITH_DEPARTMENT = 'with_department';
}