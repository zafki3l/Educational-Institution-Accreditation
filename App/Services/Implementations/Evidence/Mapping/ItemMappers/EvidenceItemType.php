<?php

namespace App\Services\Implementations\Evidence\Mapping\ItemMappers;

enum EvidenceItemType: string
{
    case BY_ID = 'by_id';
    case LIST = 'list';
    case BY_MILESTONE = 'by_milestone';
    case WITHOUT_MILESTONE = 'without_milestone';
}