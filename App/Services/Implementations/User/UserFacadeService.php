<?php

namespace App\Services\Implementations\User;

use App\DTO\CommandResult;
use App\DTO\UserDTO\UserByIdDTO;
use App\DTO\UserDTO\UserCollectionDTO;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Services\Interfaces\User\HandleLogUserServiceInterface;
use App\Services\Interfaces\User\HandleUserErrorServiceInterface;
use App\Services\Interfaces\User\UserCommandServiceInterface;
use App\Services\Interfaces\User\UserQueryServiceInterface;
use App\Services\Interfaces\User\UserFacadeServiceInterface;
use Core\Paginator;
use MongoDB\InsertOneResult;

class UserFacadeService implements UserFacadeServiceInterface
{
    public function __construct(private HandleUserErrorServiceInterface $handleUserErrorService,
                                private UserQueryServiceInterface $userQueryService,
                                private UserCommandServiceInterface $userCommandService,
                                private HandleLogUserServiceInterface $handleLogUserService) {}

    public function list(?string $search, int $current_page): array
    {
        $total_records = $this->userQueryService->count($search);

        [$total_pages, $current_page, $start_from] = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page);

        $users = $search 
            ? $this->userQueryService->find($search, $start_from, Paginator::RESULT_PER_PAGE) 
            : $this->userQueryService->findAll($start_from, Paginator::RESULT_PER_PAGE);

        return [
            'users' => $users->toArray(),
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }

    public function create(CreateUserRequest $request): InsertOneResult
    {
        $user = $this->userCommandService->setCreateUser($request);

        $created_id = $this->userCommandService->create($user);

        $created_data = $this->userQueryService->findOrFail($created_id);

        $result = new CommandResult(
            $created_id,
            $created_data->toArray(),
            $created_id ? true : false
        );

        return $this->handleLogUserService->createLog($result);
    }

    public function update(int $id, UpdateUserRequest $request): InsertOneResult
    {
        $update_data = $this->userQueryService->findOrFail($id);

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
        $delete_data = $this->userQueryService->findOrFail($id);

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
        return $this->userQueryService->findAll($start_from, $result_per_page);   
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        return $this->userQueryService->find($search, $start_from, $result_per_page);
    }

    public function findOrFail(int $id): UserByIdDTO
    {
        return $this->userQueryService->findOrFail($id);
    }

    public function count(?string $search = null): int
    {
        return $this->userQueryService->count($search);
    }
}