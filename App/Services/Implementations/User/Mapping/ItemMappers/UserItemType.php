<?php

namespace App\Services\Implementations\User\Mapping\ItemMappers;

enum UserItemType: string
{
    case BY_ID = 'by_id';
    case LIST = 'list';
}