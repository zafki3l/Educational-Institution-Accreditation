<?php

namespace App\Business\Modules\Evidence\Mappers\ItemMappers\Interfaces;

use App\Domain\Entities\DataTransferObjects\EvidenceDTO\BaseEvidenceDTO;

interface EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): BaseEvidenceDTO;
}