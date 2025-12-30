<?php

namespace App\Mappers\Standard\ItemMappers;

enum StandardItemType: string
{
    case BASE = 'base';
    case WITH_DEPARTMENT = 'with_department';
}