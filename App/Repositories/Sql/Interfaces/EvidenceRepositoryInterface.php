<?php

namespace App\Repositories\Sql\Interfaces;

use App\Entities\Models\Evidence;

interface EvidenceRepositoryInterface
{
    public function all(int $start_from, int $result_per_page): array;
    
    public function filter(int $start_from, int $result_per_page, array $filter): array;
    
    public function countAll(): int;
    

    public function linkMinestoneToEvidence(string $evidence_id, string $milestone_id): void;
    
    public function findById(string $evidence_id): array;

    public function evidenceManyToManyMilestone(string $evidence_id): array;
    
    public function updateById(string $evidence_id, Evidence $evidence): int;
    
    public function deleteById(string $evidence_id): int;
    
    public function search(string $search, int $start_from, int $result_per_page): array;
    
    public function countSearch(string $search): int;  

    public function evidenceWithoutMilestone(): array;
}