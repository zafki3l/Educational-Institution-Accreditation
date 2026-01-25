<?php

namespace App\Business\Modules\Evidence\Evidence\Factory;

use App\Business\Modules\Evidence\Evidence\ItemMappers\EvidenceBaseItemMapper;
use App\Business\Modules\Evidence\Evidence\ItemMappers\EvidenceByCriteriaItemMapper;
use App\Business\Modules\Evidence\Evidence\ItemMappers\EvidenceByIdItemMapper;
use App\Business\Modules\Evidence\Evidence\ItemMappers\EvidenceByMilestoneItemMapper;
use App\Business\Modules\Evidence\Evidence\ItemMappers\EvidenceItemType;
use App\Business\Modules\Evidence\Evidence\ItemMappers\EvidenceListItemMapper;
use App\Business\Modules\Evidence\Evidence\ItemMappers\EvidenceWithoutMilestoneItemMapper;
use App\Business\Modules\Evidence\Evidence\ItemMappers\Interfaces\EvidenceItemMapperInterface;

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