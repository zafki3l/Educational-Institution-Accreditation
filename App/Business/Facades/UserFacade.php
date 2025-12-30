<?php

namespace App\Business\Facades;

use App\Business\Commands\UserCommand;
use App\Business\ErrorHandler\UserErrorHandler;
use App\Business\FromRequestFactory\UserFromRequestFactory;
use App\Business\Logging\UserLog;
use App\Business\Queries\UserQuery;
use App\Domain\Entities\DataTransferObjects\CommandResult;
use App\Domain\Entities\DataTransferObjects\UserDTO\UserByIdDTO;
use App\Domain\Entities\DataTransferObjects\UserDTO\UserCollectionDTO;
use App\Presentation\Http\Contexts\HttpActorContext;
use App\Presentation\Http\Requests\User\CreateUserRequest;
use App\Presentation\Http\Requests\User\UpdateUserRequest;
use App\Presentation\Http\Requests\User\UserRequest;
use Core\Paginator;

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
class UserFacade
{
    public function __construct(private UserErrorHandler $errorHandler,
                                private UserQuery $query,
                                private UserCommand $command,
                                private UserFromRequestFactory $fromRequestFactory,
                                private UserLog $userLog) {}

    public function list(?string $search, int $current_page): array
    {
        $total_records = $this->count($search);

        [$total_pages, $current_page, $start_from] = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page);

        $users = $search 
            ? $this->find($search, $start_from, Paginator::RESULT_PER_PAGE) 
            : $this->findAll($start_from, Paginator::RESULT_PER_PAGE);

        return [
            'users' => $users,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }

    public function create(CreateUserRequest $request): void
    {
        $user = $this->fromRequestFactory->fromCreateRequest($request);

        $created_id = $this->command->create($user);

        $created_data = $this->findOrFail($created_id);

        $result = new CommandResult(
            $created_id,
            $created_data->toArray(),
            $created_id ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->userLog->createLog($result, $actor);
    }

    public function update(int $id, UpdateUserRequest $request): void
    {
        $requested_data = $this->findOrFail($id);

        $user = $this->fromRequestFactory->fromUpdateRequest($id, $request);

        $updated_id = $this->command->update($id, $user);

        $result = new CommandResult(
            $updated_id,
            $requested_data->toArray(),
            $updated_id ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);

        $this->userLog->updateLog($result, $actor);   
    }

    public function delete(int $id): void
    {
        $delete_data = $this->findOrFail($id);

        $deleted_rows = $this->command->delete($id);

        $result = new CommandResult(
            $id,
            $delete_data->toArray(),
            $deleted_rows > 0 ? true : false
        );

        $actor = new HttpActorContext($_SESSION['user']);
        
        $this->userLog->deleteLog($result, $actor);
    }

    public function handleError(UserRequest $request, $isUpdated = false): ?array
    {
        return $this->errorHandler->handleError($request, $isUpdated);
    }

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        return $this->query->findAll($start_from, $result_per_page);   
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        return $this->query->find($search, $start_from, $result_per_page);
    }

    public function findOrFail(int $id): UserByIdDTO
    {
        return $this->query->findOrFail($id);
    }

    public function count(?string $search = null): int
    {
        return $this->query->count($search);
    }
}