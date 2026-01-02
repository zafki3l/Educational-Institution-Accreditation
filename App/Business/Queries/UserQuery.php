<?php

namespace App\Business\Queries;

use App\Domain\Entities\DataTransferObjects\UserDTO\UserByIdDTO;
use App\Domain\Entities\DataTransferObjects\UserDTO\UserCollectionDTO;
use App\Domain\Exceptions\UserException\UserNotFoundException;
use App\Mappers\User\ItemMappers\UserItemType;
use App\Mappers\User\UserDTOMapper;
use App\Business\Ports\UserRepositoryInterface;

/**
 * Application service responsible for querying user's data
 */
class UserQuery
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private UserDTOMapper $mapper
    ) {}

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
