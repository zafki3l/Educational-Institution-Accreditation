<?php

namespace App\Services\Implementations\User;

use App\DTO\UserDTO\UserCollectionDTO;
use App\Exceptions\UserException\UserNotFoundException;
use App\Repositories\Sql\Implementations\User\MySqlUserRepository;
use App\Services\Interfaces\User\UserDTOMapperServiceInterface;

/**
 * Application service responsible for querying user's data
 */
class UserQuery
{
    public function __construct(private MySqlUserRepository $repository,
                                private UserDTOMapperServiceInterface $userDTOMapperService) {}

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->repository->all($start_from, $result_per_page);

        return $this->userDTOMapperService->map($users, new UserListItemMapperService());
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->repository->search($search, $start_from, $result_per_page);

        return $this->userDTOMapperService->map($users, new UserListItemMapperService());
    }

    public function findOrFail(int $id): UserCollectionDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new UserNotFoundException($id);
        }

        return $this->userDTOMapperService->map($found, new UserByIdItemMapperService());
    }

    public function count(?string $search = null): int
    {
        return $search 
            ? $this->repository->countSearch($search) 
            : $this->repository->countAll();
    }
}