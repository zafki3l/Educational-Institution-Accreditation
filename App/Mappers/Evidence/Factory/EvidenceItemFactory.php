<?php

namespace App\Mappers\Evidence\Factory;

use App\Mappers\Evidence\ItemMappers\EvidenceBaseItemMapper;
use App\Mappers\Evidence\ItemMappers\EvidenceByCriteriaItemMapper;
use App\Mappers\Evidence\ItemMappers\EvidenceByIdItemMapper;
use App\Mappers\Evidence\ItemMappers\EvidenceByMilestoneItemMapper;
use App\Mappers\Evidence\ItemMappers\EvidenceItemType;
use App\Mappers\Evidence\ItemMappers\EvidenceListItemMapper;
use App\Mappers\Evidence\ItemMappers\EvidenceWithoutMilestoneItemMapper;
use App\Mappers\Evidence\ItemMappers\Interfaces\EvidenceItemMapperInterface;

/**
 * Factory for creating evidence item mappers based on the specified type.
 * Supports base and department-aware mapping implementations.
 */
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
            EvidenceItemType::BASE => EvidenceBaseItemMapper::class,
            EvidenceItemType::LIST => EvidenceListItemMapper::class,
            EvidenceItemType::BY_ID => EvidenceByIdItemMapper::class,
            EvidenceItemType::BY_MILESTONE => EvidenceByMilestoneItemMapper::class,
            EvidenceItemType::BY_CRITERIA => EvidenceByCriteriaItemMapper::class,
            EvidenceItemType::WITHOUT_MILESTONE => EvidenceWithoutMilestoneItemMapper::class
        };
    }
}