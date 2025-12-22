<?php

namespace App\Services\Implementations\Evidence\Mapping\Factory;

use App\Services\Implementations\Evidence\Mapping\ItemMappers\EvidenceByIdItemMapper;
use App\Services\Implementations\Evidence\Mapping\ItemMappers\EvidenceByMilestoneItemMapper;
use App\Services\Implementations\Evidence\Mapping\ItemMappers\EvidenceItemType;
use App\Services\Implementations\Evidence\Mapping\ItemMappers\EvidenceListItemMapper;
use App\Services\Implementations\Evidence\Mapping\ItemMappers\EvidenceWithoutMilestoneItemMapper;
use App\Services\Interfaces\Evidence\Mapping\EvidenceItemMapperInterface;

class EvidenceItemFactory
{   
    public function createItemMapper(EvidenceItemType $type): EvidenceItemMapperInterface
    {
        $itemMapper = $this->resolveItemMapper($type);
        
        return new $itemMapper();
    }

    private function resolveItemMapper(EvidenceItemType $type): string
    {
        return match ($type) {
            EvidenceItemType::BY_ID => EvidenceByIdItemMapper::class,
            EvidenceItemType::LIST => EvidenceListItemMapper::class,
            EvidenceItemType::BY_MILESTONE => EvidenceByMilestoneItemMapper::class,
            EvidenceItemType::WITHOUT_MILESTONE => EvidenceWithoutMilestoneItemMapper::class
        };
    }
}