<?php

namespace App\Repositories\Interfaces;

use App\Models\Evidence;

interface EvidenceRepositoryInterface
{
    public function getAllEvidence(int $start_from, int $result_per_page): array;
    public function filterEvidences(int $start_from, int $result_per_page, array $filter): array;
    public function countAllEvidence(): int;
    public function createEvidence(Evidence $evidence): void;
    public function getEvidenceById(string $evidence_id): array;
    public function updateEvidence(string $evidence_id, Evidence $evidence): void;
    public function deleteEvidence(string $evidence_id): void;
    public function searchEvidence(string $search, int $start_from, int $result_per_page): array;
    public function countSearchEvidence(string $search): int;  
}