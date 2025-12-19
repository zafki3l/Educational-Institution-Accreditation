<?php

namespace App\Services\Implementations\User;

use App\DTO\UserDTO\UserCollectionDTO;
use App\Exceptions\UserException\UserNotFoundException;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\User\UserDTOMapperServiceInterface;
use App\Services\Interfaces\User\UserQueryServiceInterface;

/**
 * Application service responsible for querying user's data
 */
class UserQueryService implements UserQueryServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository,
                                private UserDTOMapperServiceInterface $userDTOMapperService) {}

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->userRepository->all($start_from, $result_per_page);

        return $this->userDTOMapperService->map($users, new UserListItemMapperService());
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->userRepository->search($search, $start_from, $result_per_page);

        return $this->userDTOMapperService->map($users, new UserListItemMapperService());
    }

    public function findOrFail(int $id): UserCollectionDTO
    {
        $found = $this->userRepository->findById($id);

        if (!$found) {
            throw new UserNotFoundException($id);
        }

        return $this->userDTOMapperService->map($found, new UserByIdItemMapperService());
    }

    public function count(?string $search = null): int
    {
        return $search 
            ? $this->userRepository->countSearch($search) 
            : $this->userRepository->countAll();
    }
}