<?php 

namespace App\Services\Implementations\Standard\Facade;

use App\Entities\DataTransferObjects\CommandResult;
use App\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;
use App\Entities\DataTransferObjects\StandardDTO\StandardCollectionDTO;
use App\Http\Requests\Standard\CreateStandardRequest;
use App\Services\Implementations\Standard\Command\Factory\StandardFromRequestFactory;
use App\Services\Implementations\Standard\Command\StandardCommand;
use App\Services\Implementations\Standard\Logging\StandardLog;
use App\Services\Implementations\Standard\Query\StandardQuery;
use MongoDB\InsertOneResult;

class StandardFacade
{
    public function __construct(private StandardFromRequestFactory $fromRequestFactory,
                                private StandardCommand $standardCommand,
                                private StandardQuery $standardQuery,
                                private StandardLog $standardLog) {}

    public function list(): array
    {
        return $this->allWithDepartment()->toArray();
    }

    public function create(CreateStandardRequest $request): InsertOneResult
    {
        $standard = $this->fromRequestFactory->fromCreateRequest($request);

        $created_id = $this->standardCommand->create($standard);

        $result = new CommandResult(
            $created_id,
            $this->findOrFail($created_id)->toArray(),
            $created_id ? true : false
        );

        return $this->standardLog->createLog($result);
    }

    public function delete(string $standard_id): InsertOneResult
    {
        $found = $this->findOrFail($standard_id);

        $deleted_rows = $this->standardCommand->delete($standard_id);

        $result = new CommandResult(
            $standard_id,
            $found->toArray(),
            $deleted_rows > 0 ? true : false
        );
                
        return $this->standardLog->deleteLog($result);
    }

    public function allWithDepartment(): StandardCollectionDTO
    {
        return $this->standardQuery->allWithDepartment();
    }

    public function findAll(): StandardCollectionDTO
    {
        return $this->standardQuery->findAll();
    }

    public function findOrFail(string $standard_id): BaseStandardDTO
    {
        return $this->standardQuery->findOrFail($standard_id);
    }

    public function count(): int
    {
        return $this->standardQuery->count();
    }
}