<?php

namespace App\Services\Implementations\User\Facade;

use App\DTO\CommandResult;
use App\DTO\UserDTO\UserByIdDTO;
use App\DTO\UserDTO\UserCollectionDTO;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Services\Implementations\User\Query\UserQuery;
use App\Services\Interfaces\User\HandleLogUserServiceInterface;
use App\Services\Interfaces\User\HandleUserErrorServiceInterface;
use App\Services\Interfaces\User\UserCommandServiceInterface;
use Core\Paginator;
use MongoDB\InsertOneResult;

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
    public function __construct(private HandleUserErrorServiceInterface $handleUserErrorService,
                                private UserQuery $userQuery,
                                private UserCommandServiceInterface $userCommandService,
                                private HandleLogUserServiceInterface $handleLogUserService) {}

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

    public function create(CreateUserRequest $request): InsertOneResult
    {
        $user = $this->userCommandService->setCreateUser($request);

        $created_id = $this->userCommandService->create($user);

        $created_data = $this->findOrFail($created_id);

        $result = new CommandResult(
            $created_id,
            $created_data->toArray(),
            $created_id ? true : false
        );

        return $this->handleLogUserService->createLog($result);
    }

    public function update(int $id, UpdateUserRequest $request): InsertOneResult
    {
        $update_data = $this->findOrFail($id);

        $user = $this->userCommandService->setUpdateUser($request);

        $updated_id = $this->userCommandService->update($id, $user);

        $result = new CommandResult(
            $updated_id,
            $update_data->toArray(),
            $updated_id ? true : false
        );

        return $this->handleLogUserService->updateLog($result);   
    }

    public function delete(int $id): InsertOneResult
    {
        $delete_data = $this->findOrFail($id);

        $deleted_rows = $this->userCommandService->delete($id);

        $result = new CommandResult(
            $id,
            $delete_data->toArray(),
            $deleted_rows > 0 ? true : false
        );
        
        return $this->handleLogUserService->deleteLog($result);
    }

    public function handleError(UserRequest $request, $isUpdated = false): ?array
    {
        return $this->handleUserErrorService->handleError($request, $isUpdated);
    }

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        return $this->userQuery->findAll($start_from, $result_per_page);   
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        return $this->userQuery->find($search, $start_from, $result_per_page);
    }

    public function findOrFail(int $id): UserByIdDTO
    {
        return $this->userQuery->findOrFail($id);
    }

    public function count(?string $search = null): int
    {
        return $this->userQuery->count($search);
    }
}