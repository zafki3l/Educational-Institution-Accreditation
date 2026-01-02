<?php

namespace App\Business\Facades;

use App\Business\Commands\MilestoneCommand;
use App\Business\FromRequestFactory\MilestoneFromRequestFactory;
use App\Business\Logging\MilestoneLog;
use App\Business\Queries\MilestoneQuery;
use App\Business\Traits\FilterHelper;
use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\BaseMilestoneDTO;
use App\Domain\Entities\DataTransferObjects\MilestoneDTO\MilestoneCollectionDTO;
use App\Presentation\Http\Contexts\HttpActorContext;
use App\Presentation\Http\Requests\Milestone\CreateMilestoneRequest;

class MilestoneFacade
{
    use FilterHelper;

    public function __construct(
        private MilestoneQuery $query,
        private MilestoneFromRequestFactory $fromRequestFactory,
        private MilestoneCommand $command,
        private MilestoneLog $log
    ) {}

    public function list(?string $search, array $filter): MilestoneCollectionDTO
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filter($filter);

        return $this->findAll();
    }

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

    public function filter(array $filter): MilestoneCollectionDTO
    {
        return $this->query->filter($filter);
    }

    public function findAll(): MilestoneCollectionDTO
    {
        return $this->query->findAll();
    }

    public function find(?string $search): MilestoneCollectionDTO
    {
        return $this->query->find($search);
    }

    private function findOrFail(string $id): BaseMilestoneDTO
    {
        return $this->query->findOrFail($id);
    }

    public function count(): int
    {
        return $this->query->count();
    }
}
