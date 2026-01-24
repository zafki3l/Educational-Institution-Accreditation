<?php

namespace App\Business\Modules\Standard;

use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Domain\Entities\DataTransferObjects\StandardDTO\BaseStandardDTO;
use App\Domain\Entities\DataTransferObjects\StandardDTO\StandardCollectionDTO;
use App\Presentation\Http\Contexts\HttpActorContext;
use App\Presentation\Http\Requests\Standard\CreateStandardRequest;

/**
 * High-level application service responsible for orchestrating
 * standard-related use cases.
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
class StandardFacade
{
    public function __construct(
        private StandardFromRequestFactory $fromRequestFactory,
        private StandardCommand $standardCommand,
        private StandardQuery $standardQuery,
        private StandardLog $standardLog
    ) {}

    /**
     * @return array
     */
    public function list(): array
    {
        return $this->allWithDepartment()->toArray();
    }

    /**
     * @param CreateStandardRequest $request
     * @return void
     */
    public function create(CreateStandardRequest $request): void
    {
        $standard = $this->fromRequestFactory->fromCreateRequest($request);

        $created_id = $this->standardCommand->create($standard);

        $result = new CommandResult(
            $created_id,
            $this->findOrFail($created_id)->toArray(),
            $created_id ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->standardLog->createLog($result, $actor);
    }

    /**
     * @param string $standard_id
     * @return void
     */
    public function delete(string $standard_id): void
    {
        $found = $this->findOrFail($standard_id);

        $deleted_rows = $this->standardCommand->delete($standard_id);

        $result = new CommandResult(
            $standard_id,
            $found->toArray(),
            $deleted_rows > 0 ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->standardLog->deleteLog($result, $actor);
    }

    /**
     * @return StandardCollectionDTO
     */
    public function allWithDepartment(): StandardCollectionDTO
    {
        return $this->standardQuery->allWithDepartment();
    }

    /**
     * @return StandardCollectionDTO
     */
    public function findAll(): StandardCollectionDTO
    {
        return $this->standardQuery->findAll();
    }

    /**
     * @param string $standard_id
     * @return BaseStandardDTO
     */
    public function findOrFail(string $standard_id): BaseStandardDTO
    {
        return $this->standardQuery->findOrFail($standard_id);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->standardQuery->count();
    }
}
