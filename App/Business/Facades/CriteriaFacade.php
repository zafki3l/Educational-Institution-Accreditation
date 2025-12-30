<?php 

namespace App\Business\Facades;

use App\Business\Commands\CriteriaCommand;
use App\Business\FromRequestFactory\CriteriaFromRequestFactory;
use App\Business\Logging\CriteriaLog;
use App\Business\Queries\CriteriaQuery;
use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Presentation\Http\Contexts\HttpActorContext;
use App\Presentation\Http\Requests\Criteria\CreateCriteriaRequest;
use Traits\FilterHelperTrait;

class CriteriaFacade
{
    use FilterHelperTrait;

    public function __construct(private CriteriaCommand $command,
                                private CriteriaFromRequestFactory $fromRequestFactory,
                                private CriteriaLog $log,
                                private CriteriaQuery $query){}

    public function list(?string $search, array $filter): array
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
            $this->findOrFail($criteria->getId()),
            $created_id ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->log->createLog($result, $actor);
    }

    public function delete(string $id): void
    {
        $found = $this->findOrFail($id);

        $deleted_rows = $this->command->delete($id);

        $result = new CommandResult($id, $found, $deleted_rows > 0 ? true : false);

        $actor = new HttpActorContext($_SESSION['user']);

        $this->log->deleteLog($result, $actor);
    }

    public function filter(array $filter): array
    {
        return $this->query->filter($filter);
    }

    public function findAll(): array
    {
        return $this->query->findAll();
    }

    public function find(?string $search): array
    {
        return $this->query->find($search);
    }
    
    public function findOrFail(string $id): array
    {
        return $this->query->findOrFail($id);
    }

    public function count(): int
    {
        return $this->query->count();
    }
}