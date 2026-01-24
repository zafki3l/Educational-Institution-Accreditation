<?php

namespace App\Business\Modules\Criteria;

use App\Business\Traits\FilterHelper;
use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaByIdDTO;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaCollectionDTO;
use App\Presentation\Http\Contexts\HttpActorContext;
use App\Presentation\Http\Requests\Criteria\CreateCriteriaRequest;

/**
 * High-level application service responsible for orchestrating
 * user-related use cases.
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
class CriteriaFacade
{
    use FilterHelper;

    public function __construct(
        private CriteriaCommand $command,
        private CriteriaFromRequestFactory $fromRequestFactory,
        private CriteriaLog $log,
        private CriteriaQuery $query
    ) {}

    /**
     * @param mixed $search
     * @param array $filter
     * @return CriteriaCollectionDTO
     */
    public function list(?string $search, array $filter): CriteriaCollectionDTO
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filter($filter);

        return $this->findAll();
    }

    /**
     * @param CreateCriteriaRequest $request
     * @return void
     */
    public function create(CreateCriteriaRequest $request): void
    {
        $criteria = $this->fromRequestFactory->fromCreateRequest($request);

        $created_id = $this->command->create($criteria);

        $result = new CommandResult(
            $criteria->getId(),
            $this->findOrFail($criteria->getId())->toArray(),
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
     * @return CriteriaCollectionDTO
     */
    public function filter(array $filter): CriteriaCollectionDTO
    {
        return $this->query->filter($filter);
    }

    /**
     * @return CriteriaCollectionDTO
     */
    public function findAll(): CriteriaCollectionDTO
    {
        return $this->query->findAll();
    }

    /**
     * @param mixed $search
     * @return CriteriaCollectionDTO
     */
    public function find(?string $search): CriteriaCollectionDTO
    {
        return $this->query->find($search);
    }

    /**
     * @param string $id
     * @return CriteriaByIdDTO
     */
    public function findOrFail(string $id): CriteriaByIdDTO
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
    public function groupCriteriaWithStandard(): array
    {
        $criterias = $this->query->criteriaByStandard();

        return (new CriteriaGrouping())->groupByStandard($criterias->toArray());
    }
}
