<?php

namespace App\Repositories\Interfaces;

use App\Models\Evidence;

interface EvidenceRepositoryInterface
{
    public function all(int $start_from, int $result_per_page): array;
    public function filter(int $start_from, int $result_per_page, array $filter): array;
    public function countAll(): int;
    public function create(Evidence $evidence): void;
    public function findById(string $evidence_id): array;
    public function updateById(string $evidence_id, Evidence $evidence): int;
    public function deleteById(string $evidence_id): int;
    public function search(string $search, int $start_from, int $result_per_page): array;
    public function countSearch(string $search): int;  
}