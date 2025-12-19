<?php

namespace App\Services\Interfaces\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;

interface EvidenceDTOMapperInterface
{
    public function map(array $evidences, EvidenceItemMapperInterface $itemMapper): EvidenceCollectionDTO;
}