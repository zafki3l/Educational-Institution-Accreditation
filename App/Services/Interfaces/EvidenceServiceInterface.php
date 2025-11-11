<?php

namespace App\Services\Interfaces;

interface EvidenceServiceInterface
{
    public function listEvidences(?string $search, int $current_page): array;
    public function createEvidence(array $request): void;
    public function getEvidenceById(string $evidence_id): array;
    public function updateEvidence(string $evidence_id, array $request): void;
    public function deleteEvidence(string $evidence_id): void;
    public function findAll(int $start_from, int $result_per_page): array;
    public function find(string $search, int $start_from, int $result_per_page): array;
}