<?php

namespace App\Business\Modules\Evidence\Evidence\ItemMappers;

enum EvidenceItemType: string
{
    case BASE = 'base';
    case LIST = 'list';
    case BY_ID = 'by_id';
    case BY_MILESTONE = 'by_milestone';
    case BY_CRITERIA = 'by_criteria';
    case WITHOUT_MILESTONE = 'without_milestone';
}