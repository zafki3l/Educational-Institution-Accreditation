<?php

namespace App\Services\Interfaces\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;

interface EvidenceDTOMapperServiceInterface
{
    public function map(array $evidences, EvidenceItemMapperServiceInterface $itemMapper): EvidenceCollectionDTO;
}