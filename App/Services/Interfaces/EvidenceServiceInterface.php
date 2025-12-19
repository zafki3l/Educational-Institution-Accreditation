<?php

namespace App\Services\Interfaces;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;

interface EvidenceServiceInterface
{
    public function list(?string $search, int $current_page, array $filter): array;

    public function create(CreateEvidenceRequest $request): void;
    
    public function evidenceMilestone(string $evidence_id): array;

    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO;

    public function findAllWithoutMilestone(): EvidenceCollectionDTO;
    
    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO;
    
    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO;

    public function findOrFail(string $evidence_id): EvidenceCollectionDTO;
    
    public function update(string $evidence_id, UpdateEvidenceRequest $request): void;
    
    public function delete(string $evidence_id): void;

    public function addMilestone($evidence_id, $milestone_id): void;

    public function count(?string $search = null): int;
}