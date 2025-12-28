<?php

namespace App\Services\Implementations\Evidence\Facade;

use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByIdDTO;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceCollectionDTO;
use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;
use App\Services\Implementations\Evidence\Command\EvidenceCommand;
use App\Services\Implementations\Evidence\Command\Factory\EvidenceFromRequestFactory;
use App\Services\Implementations\Evidence\Logging\EvidenceLog;
use App\Services\Implementations\Evidence\Query\EvidenceQuery;
use Core\Paginator;
use MongoDB\InsertOneResult;
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
                                private EvidenceFromRequestFactory $fromRequestFactory,
                                private EvidenceCommand $evidenceCommand,
                                private EvidenceLog $log) {}

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
    
    public function create(CreateEvidenceRequest $request): InsertOneResult
    {
        $evidence = $this->fromRequestFactory->fromCreateRequest($request);

        $created_id = $this->evidenceCommand->create($evidence);

        $result = new CommandResult(
            $created_id,
            $this->evidenceQuery->findOrFail($created_id)->toArray(),
            $created_id ? true : false
        );

        return $this->log->createLog($result);
    }

    public function update(string $id, UpdateEvidenceRequest $request): InsertOneResult
    {
        $found = $this->evidenceQuery->findOrFail($id)->toArray();

        $evidence = $this->fromRequestFactory->fromUpdateRequest($id, $found, $request);

        $updated_id = $this->evidenceCommand->update($id, $evidence);

        $result = new CommandResult(
            $updated_id,
            $found,
            $updated_id ? true : false
        );

        return $this->log->updateLog($result);
    }

    public function delete(string $id): InsertOneResult
    {
        $found = $this->findOrFail($id)->toArray();

        $deleted_rows = $this->evidenceCommand->delete($id);

        $result = new CommandResult(
            $id,
            $found,
            $deleted_rows > 0 ? true : false
        );

        return $this->log->deleteLog($result);
    }

    public function addMilestone($id, $milestone_id): InsertOneResult
    {
        $found = $this->findOrFail($id);

        $update_id = $this->evidenceCommand->addMilestone($id, $milestone_id);

        $result = new CommandResult(
            $id,
            $found->toArray(),
            $update_id ? true : false
        );

        return $this->log->addMilestoneLog($milestone_id, $result);
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

    public function findOrFail(string $id): EvidenceByIdDTO
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