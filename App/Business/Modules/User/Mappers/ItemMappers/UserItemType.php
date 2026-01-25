<?php

namespace App\Business\Modules\User\Mappers\ItemMappers;

enum UserItemType: string
{
    case BY_ID = 'by_id';
    case LIST = 'list';
}