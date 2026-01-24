<?php

namespace App\Business\Modules\Milestone;

use App\Business\Traits\FilterHelper;
use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\MilestoneCollectionDTO;
use App\Presentation\Http\Contexts\HttpActorContext;
use App\Presentation\Http\Requests\Milestone\CreateMilestoneRequest;

/**
 * High-level application service responsible for orchestrating
 * milestone-related use cases.
 *
 * This service acts as a Facade:
 * - Coordinates Query Services and Command Services
 * - Delegates logging and error handling to dedicated services
 * - Encapsulates complex workflows into simple public methods
 *
 * It hides internal business logic and interaction details from
 * controllers.
 *
 * The Facade does NOT contain business rules or persistence logic.
 * Its sole responsibility is orchestration and flow control.
 */
class MilestoneFacade
{
    use FilterHelper;

    public function __construct(
        private MilestoneQuery $query,
        private MilestoneFromRequestFactory $fromRequestFactory,
        private MilestoneCommand $command,
        private MilestoneLog $log
    ) {}

    /**
     * @param mixed $search
     * @param array $filter
     * @return MilestoneCollectionDTO
     */
    public function list(?string $search, array $filter): MilestoneCollectionDTO
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filter($filter);

        return $this->findAll();
    }

    /**
     * @param CreateMilestoneRequest $request
     * @return void
     */
    public function create(CreateMilestoneRequest $request): void
    {
        $milestone = $this->fromRequestFactory->fromCreateRequest($request);

        $created_id = $this->command->create($milestone);

        $result = new CommandResult(
            $created_id,
            $this->findOrFail($request->getId())->toArray(),
            $created_id ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->log->createLog($result, $actor);
    }

    /**
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $found = $this->findOrFail($id);

        $deleted_rows = $this->command->delete($id);

        $result = new CommandResult(
            $id,
            $found->toArray(),
            $deleted_rows > 0 ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->log->deleteLog($result, $actor);
    }

    /**
     * @param array $filter
     * @return MilestoneCollectionDTO
     */
    public function filter(array $filter): MilestoneCollectionDTO
    {
        return $this->query->filter($filter);
    }

    /**
     * @return MilestoneCollectionDTO
     */
    public function findAll(): MilestoneCollectionDTO
    {
        return $this->query->findAll();
    }

    /**
     * @param mixed $search
     * @return MilestoneCollectionDTO
     */
    public function find(?string $search): MilestoneCollectionDTO
    {
        return $this->query->find($search);
    }

    /**
     * @param string $id
     * @return BaseMilestoneDTO
     */
    private function findOrFail(string $id): BaseMilestoneDTO
    {
        return $this->query->findOrFail($id);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->query->count();
    }

    /**
     * @return array
     */
    public function groupMilestoneWithCriteria(): array
    {
        $milestones = $this->query->milestoneByCriteria();

        return (new MilestoneGrouping())->groupByCriteria($milestones->toArray());
    }
}
