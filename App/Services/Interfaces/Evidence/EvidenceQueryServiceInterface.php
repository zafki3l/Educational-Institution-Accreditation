<?php

namespace App\Services\Interfaces\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;

interface EvidenceQueryServiceInterface
{
    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO;

    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO;

    public function findAllWithoutMilestone(): EvidenceCollectionDTO;

    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO;

    public function findOrFail(string $evidence_id): EvidenceCollectionDTO;

    public function count(?string $search = null): int;
}