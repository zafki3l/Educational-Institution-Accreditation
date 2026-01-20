<?php

namespace App\Business\Ports;

interface EvidenceRepositoryInterface
{
    public function all(int $start_from, int $result_per_page): array;

    public function filter(int $start_from, int $result_per_page, array $filter): array;

    public function countAll(): int;

    public function create(array $evidence): int;

    public function linkMinestoneToEvidence(string $evidence_id, string $milestone_id): int;

    public function findById(string $evidence_id): array;

    public function evidenceManyToManyMilestone(string $evidence_id): array;

    public function evidenceWithoutMilestone(): array;

    public function byCriteria(): array;

    public function updateById(string $id, array $evidence): string;

    public function deleteById(string $evidence_id): int;

    public function search(string $search, int $start_from, int $result_per_page): array;

    public function countSearch(string $search): int;
}