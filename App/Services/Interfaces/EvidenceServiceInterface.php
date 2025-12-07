<?php

namespace App\Services\Interfaces;

interface EvidenceServiceInterface
{
    public function list(?string $search, int $current_page, array $filter): array;

    public function create(array $request): void;

    public function findAll(int $start_from, int $result_per_page): array;
    
    public function findById(string $evidence_id): array;

    public function evidenceMilestone(string $evidence_id): array;
    
    public function find(string $search, int $start_from, int $result_per_page): array;
    
    public function filterEvidences(int $start_from, int $result_per_page, array $filter): array;
    
    public function update(string $evidence_id, array $request): void;
    
    public function delete(string $evidence_id): void;

    public function addMilestone($evidence_id, $milestone_id): void;

    public function findAllWithoutMilestone(): array;

    public function count(?string $search = null): int;
}