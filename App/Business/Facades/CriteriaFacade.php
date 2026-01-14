<?php

namespace App\Business\Facades;

use App\Business\Commands\CriteriaCommand;
use App\Business\FromRequestFactory\CriteriaFromRequestFactory;
use App\Business\Grouping\CriteriaGrouping;
use App\Business\Logging\CriteriaLog;
use App\Business\Queries\CriteriaQuery;
use App\Business\Traits\FilterHelper;
use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaByIdDTO;
use App\Domain\Entities\DataTransferObjects\CriteriaDTO\CriteriaCollectionDTO;
use App\Presentation\Http\Contexts\HttpActorContext;
use App\Presentation\Http\Requests\Criteria\CreateCriteriaRequest;

class CriteriaFacade
{
    use FilterHelper;

    public function __construct(
        private CriteriaCommand $command,
        private CriteriaFromRequestFactory $fromRequestFactory,
        private CriteriaLog $log,
        private CriteriaQuery $query
    ) {}

    public function list(?string $search, array $filter): CriteriaCollectionDTO
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filter($filter);

        return $this->findAll();
    }

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

    public function filter(array $filter): CriteriaCollectionDTO
    {
        return $this->query->filter($filter);
    }

    public function findAll(): CriteriaCollectionDTO
    {
        return $this->query->findAll();
    }

    public function find(?string $search): CriteriaCollectionDTO
    {
        return $this->query->find($search);
    }

    public function findOrFail(string $id): CriteriaByIdDTO
    {
        return $this->query->findOrFail($id);
    }

    public function count(): int
    {
        return $this->query->count();
    }

    public function groupCriteriaWithStandard(): array
    {
        $criterias = $this->query->criteriaByStandard();

        return (new CriteriaGrouping())->groupByStandard($criterias->toArray());
    }
}
