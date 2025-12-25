<?php

namespace App\Services\Interfaces\Evidence\Mapping;

use App\Entities\DataTransferObjects\EvidenceDTO\BaseEvidenceDTO;

interface EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): BaseEvidenceDTO;
}