<?php

namespace App\Services\Implementations\Evidence\Facade;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;
use App\Models\Evidence;
use App\Repositories\Sql\Interfaces\EvidenceRepositoryInterface;
use App\Services\Implementations\Evidence\Command\EvidenceCommand;
use App\Services\Implementations\Evidence\FileUpload\EvidenceFileUpload;
use App\Services\Implementations\Evidence\Query\EvidenceQuery;
use App\Services\Interfaces\Evidence\EvidenceQueryServiceInterface;
use App\Services\Interfaces\FileUploadServiceInterface;
use Core\Paginator;
use Traits\FilterHelperTrait;

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
class EvidenceFacade
{
    use FilterHelperTrait;

    public function __construct(private EvidenceQuery $evidenceQuery,
                                private EvidenceCommand $evidenceCommand) {}

    public function list(?string $search, int $current_page, array $filter): array
    {
        $filter = $this->filterArray($filter);

        $total_records = $this->count($search);

        [$total_pages, $current_page, $start_from] = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page);

        $evidences = $this->findAll($start_from, Paginator::RESULT_PER_PAGE);
        
        if ($search) {
            $evidences = $this->find($search, $start_from, Paginator::RESULT_PER_PAGE);
        }
        
        if ($filter) {
            $evidences = $this->filterEvidences($start_from, Paginator::RESULT_PER_PAGE, $filter);
        }

        return [
            'evidences' => $evidences,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }
    
    public function create(CreateEvidenceRequest $request): void
    {
        $evidence = $this->evidenceCommand->setCreate($request);

        $created_id = $this->evidenceCommand->create($evidence);
    }

    public function update(string $id, UpdateEvidenceRequest $request): void
    {
        $found = $this->evidenceQuery->findOrFail($id)->toArray();

        $evidence = $this->evidenceCommand->setUpdate($found, $request);

        $updated_id = $this->evidenceCommand->update($id, $evidence);
    }

    public function delete(string $id): void
    {
        $this->findOrFail($id);

        $deleted_rows = $this->evidenceCommand->delete($id);
    }

    public function addMilestone($id, $milestone_id): int
    {
        return $this->evidenceCommand->addMilestone($id, $milestone_id);
    }

    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->findAll($start_from, $result_per_page);
    }

    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->find($search, $start_from, $result_per_page);
    }

    public function findAllWithoutMilestone(): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->findAllWithoutMilestone();
    }

    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->filterEvidences($start_from, $result_per_page, $filter);
    }

    public function findOrFail(string $id): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->findOrFail($id);
    }

    public function evidenceByMilestone(string $id): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->evidenceByMilestone($id);
    }

    public function count(?string $search = null): int
    {
        return $this->evidenceQuery->count($search);
    }
}