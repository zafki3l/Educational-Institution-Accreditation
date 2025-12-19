<?php

namespace App\Services\Interfaces\Evidence;

use App\DTO\EvidenceDTO\BaseEvidenceDTO;

interface EvidenceItemMapperInterface
{
    public function mapItem(array $evidence): BaseEvidenceDTO;
}