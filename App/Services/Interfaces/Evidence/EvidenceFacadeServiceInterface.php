<?php

namespace App\Services\Interfaces\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;

/**
 *
 * High-level application service responsible for orchestrating
 * evidence-related use cases.
 *
 * This service acts as a Facade:
 * - Coordinates Query Services and Command Services
 * - Delegates logging and error handling to dedicated services
 * - Encapsulates complex workflows into simple public methods
 *
 * It hides internal business logic and interaction details from
 * controllers, providing a clean and stable interface for the
 * presentation layer.
 *
 * The Facade does NOT contain business rules or persistence logic.
 * Its sole responsibility is orchestration and flow control.
 */
interface EvidenceFacadeServiceInterface
{
    public function list(?string $search, int $current_page, array $filter): array;
    
    public function create(CreateEvidenceRequest $request): void;

    public function update(string $id, UpdateEvidenceRequest $request): void;

    public function delete(string $id): void;

    public function addMilestone($id, $milestone_id): void;

    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO;

    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO;
    
    public function findAllWithoutMilestone(): EvidenceCollectionDTO;

    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO;

    public function findOrFail(string $id): EvidenceCollectionDTO;

    public function evidenceByMilestone(string $id): EvidenceCollectionDTO;

    public function count(?string $search = null): int;
}