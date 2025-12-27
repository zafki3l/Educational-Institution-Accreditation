<?php 

namespace App\Services\Implementations\Standard\Facade;

use App\Entities\DataTransferObjects\CommandResult;
use App\Http\Requests\Standard\CreateStandardRequest;
use App\Models\Standard;
use App\Repositories\Sql\Implementations\Standard\MysqlStandardRepository;
use App\Services\Implementations\Logging\LogService;
use App\Services\Implementations\Standard\Command\Factory\StandardFromRequestFactory;
use App\Services\Implementations\Standard\Command\StandardCommand;
use App\Services\Implementations\Standard\Logging\StandardLog;
use App\Services\Implementations\Standard\Query\StandardQuery;
use MongoDB\InsertOneResult;

class StandardFacade
{
    public function __construct(private MysqlStandardRepository $standardRepository,
                                private StandardFromRequestFactory $fromRequestFactory,
                                private StandardCommand $standardCommand,
                                private StandardQuery $standardQuery,
                                private StandardLog $standardLog) {}

    public function list(): array
    {
        return $this->standardQuery->allWithDepartment();
    }

    public function create(CreateStandardRequest $request): InsertOneResult
    {
        $standard = $this->fromRequestFactory->fromCreateRequest($request);

        $created_id = $this->standardCommand->create($standard);

        $result = new CommandResult(
            $created_id,
            $this->findOrFail($created_id),
            $created_id ? true : false
        );

        return $this->standardLog->createLog($result);
    }

    public function delete(string $standard_id): InsertOneResult
    {
        $found = $this->findOrFail($standard_id);

        $deleted_rows = $this->standardRepository->deleteById($standard_id);

        $result = new CommandResult(
            $standard_id,
            $found,
            $deleted_rows > 0 ? true : false
        );
                
        return $this->standardLog->deleteLog($result);
    }

    public function findAll(): array
    {
        return $this->standardQuery->findAll();
    }

    public function findOrFail(string $standard_id): array
    {
        return $this->standardQuery->findOrFail($standard_id);
    }

    public function count(): int
    {
        return $this->standardQuery->count();
    }
}