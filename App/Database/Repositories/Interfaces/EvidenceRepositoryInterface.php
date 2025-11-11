<?php

namespace App\Database\Repositories\Interfaces;

use App\Database\Models\Evidence;

interface EvidenceRepositoryInterface
{
    public function getAllEvidence(int $start_from, int $result_per_page): array;
    public function countAllEvidence(): int;
    public function createEvidence(Evidence $evidence): void;
    public function getEvidenceById(string $evidence_id): array;
    public function updateEvidence(string $evidence_id, Evidence $evidence): void;
    public function deleteEvidence(string $evidence_id): void;
    public function searchEvidence(string $search, int $start_from, int $result_per_page): array;
    public function countSearchEvidence(string $search): int;  
}