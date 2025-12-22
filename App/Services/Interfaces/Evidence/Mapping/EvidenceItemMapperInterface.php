<?php

namespace App\Services\Interfaces\Evidence\Mapping;

use App\DTO\EvidenceDTO\BaseEvidenceDTO;

interface EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): BaseEvidenceDTO;
}