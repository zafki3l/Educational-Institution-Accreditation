<?php

namespace App\Mappers\Criteria\ItemMappers;

enum CriteriaItemType: string 
{
    case WITH_DEPARTMENT = 'with_department';
    case BY_ID = 'by_id';
    case BY_STANDARD = 'by_standard';
}