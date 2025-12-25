<?php

namespace App\Services\Implementations\User\Query;

use App\Entities\DataTransferObjects\UserDTO\UserByIdDTO;
use App\Entities\DataTransferObjects\UserDTO\UserCollectionDTO;
use App\Exceptions\UserException\UserNotFoundException;
use App\Repositories\Sql\Implementations\User\MySqlUserRepository;
use App\Services\Implementations\User\Mapping\ItemMappers\UserItemType;
use App\Services\Implementations\User\Mapping\UserDTOMapper;

/**
 * Application service responsible for querying user's data
 */
class UserQuery
{
    public function __construct(private MySqlUserRepository $repository,
                                private UserDTOMapper $mapper) {}

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->repository->all($start_from, $result_per_page);

        return $this->mapper->map($users, UserItemType::LIST);
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->repository->search($search, $start_from, $result_per_page);

        return $this->mapper->map($users, UserItemType::LIST);
    }

    public function findOrFail(int $id): UserByIdDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new UserNotFoundException($id);
        }

        return $this->mapper->mapOne($found[0], UserItemType::BY_ID);
    }

    public function count(?string $search = null): int
    {
        return $search 
            ? $this->repository->countSearch($search) 
            : $this->repository->countAll();
    }
}