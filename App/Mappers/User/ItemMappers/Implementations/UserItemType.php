<?php

namespace App\Mappers\User\ItemMappers\Implementations;

enum UserItemType: string
{
    case BY_ID = 'by_id';
    case LIST = 'list';
}