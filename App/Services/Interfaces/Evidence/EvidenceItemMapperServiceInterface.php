<?php

namespace App\Services\Interfaces\Evidence;

use App\DTO\EvidenceDTO\BaseEvidenceDTO;

interface EvidenceItemMapperServiceInterface
{
    public function mapItem(array $evidence): BaseEvidenceDTO;
}