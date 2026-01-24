<?php

namespace App\Business\Modules\Evidence;

use App\Business\Traits\FilterHelper;
use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByIdDTO;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceCollectionDTO;
use App\Infrastructure\Paginator\Paginator;
use App\Presentation\Http\Contexts\HttpActorContext;
use App\Presentation\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Presentation\Http\Requests\Evidence\UpdateEvidenceRequest;

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
    use FilterHelper;

    public function __construct(
        private EvidenceQuery $evidenceQuery,
        private EvidenceFromRequestFactory $fromRequestFactory,
        private EvidenceCommand $evidenceCommand,
        private EvidenceLog $log
    ) {}

    /**
     * @param mixed $search
     * @param int $current_page
     * @param array $filter
     * @return array{current_page: mixed, evidences: EvidenceCollectionDTO, result_per_page: int, total_pages: mixed}
     */
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

    /**
     * @param CreateEvidenceRequest $request
     * @return void
     */
    public function create(CreateEvidenceRequest $request): void
    {
        $evidence = $this->fromRequestFactory->fromCreateRequest($request);

        $created_id = $this->evidenceCommand->create($evidence);

        $result = new CommandResult(
            $created_id,
            $this->evidenceQuery->findOrFail($created_id)->toArray(),
            $created_id ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->log->createLog($result, $actor);
    }

    /**
     * @param string $id
     * @param UpdateEvidenceRequest $request
     * @return void
     */
    public function update(string $id, UpdateEvidenceRequest $request): void
    {
        $found = $this->evidenceQuery->findOrFail($id);

        $evidence = $this->fromRequestFactory->fromUpdateRequest($id, $found, $request);

        $updated_id = $this->evidenceCommand->update($id, $evidence);

        $result = new CommandResult(
            $updated_id,
            $found->toArray(),
            $updated_id ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->log->updateLog($result, $actor);
    }

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $found = $this->findOrFail($id)->toArray();

        $deleted_rows = $this->evidenceCommand->delete($id);

        $result = new CommandResult(
            $id,
            $found,
            $deleted_rows > 0 ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->log->deleteLog($result, $actor);
    }

    /**
     * @param mixed $id
     * @param mixed $milestone_id
     * @return void
     */
    public function addMilestone($id, $milestone_id): void
    {
        $found = $this->findOrFail($id);

        $update_id = $this->evidenceCommand->addMilestone($id, $milestone_id);

        $result = new CommandResult(
            $id,
            $found->toArray(),
            $update_id ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->log->addMilestoneLog($milestone_id, $result, $actor);
    }

    /**
     * @param int $start_from
     * @param int $result_per_page
     * @return EvidenceCollectionDTO
     */
    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->findAll($start_from, $result_per_page);
    }

    /**
     * @param string $search
     * @param int $start_from
     * @param int $result_per_page
     * @return EvidenceCollectionDTO
     */
    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->find($search, $start_from, $result_per_page);
    }

    /**
     * @return EvidenceCollectionDTO
     */
    public function findAllWithoutMilestone(): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->findAllWithoutMilestone();
    }

    /**
     * @param int $start_from
     * @param int $result_per_page
     * @param array $filter
     * @return EvidenceCollectionDTO
     */
    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->filterEvidences($start_from, $result_per_page, $filter);
    }

    /**
     * @param string $id
     * @return EvidenceByIdDTO
     */
    public function findOrFail(string $id): EvidenceByIdDTO
    {
        return $this->evidenceQuery->findOrFail($id);
    }

    /**
     * @param string $id
     * @return EvidenceCollectionDTO
     */
    public function evidenceByMilestone(string $id): EvidenceCollectionDTO
    {
        return $this->evidenceQuery->evidenceByMilestone($id);
    }

    /**
     * @param mixed $search
     * @return int
     */
    public function count(?string $search = null): int
    {
        return $this->evidenceQuery->count($search);
    }

    /**
     * @return array
     */
    public function groupByCriteria(): array
    {
        $evidences = $this->evidenceQuery->byCriteria();

        return (new EvidenceGrouping())->groupByCriteria($evidences->toArray());
    }
}
