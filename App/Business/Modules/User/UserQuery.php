<?php

namespace App\Business\Modules\User;

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

    /**
     * @param int $start_from
     * @param int $result_per_page
     * @return UserCollectionDTO
     */
    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->repository->all($start_from, $result_per_page);

        return $this->mapper->map($users, UserItemType::LIST);
    }

    /**
     * @param string $search
     * @param int $start_from
     * @param int $result_per_page
     * @return UserCollectionDTO
     */
    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->repository->search($search, $start_from, $result_per_page);

        return $this->mapper->map($users, UserItemType::LIST);
    }

    /**
     * @param int $id
     * @throws UserNotFoundException
     * @return \App\Domain\Entities\DataTransferObjects\UserDTO\BaseUserDTO
     */
    public function findOrFail(int $id): UserByIdDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new UserNotFoundException($id);
        }

        return $this->mapper->mapOne($found[0], UserItemType::BY_ID);
    }

    /**
     * @param mixed $search
     * @return int
     */
    public function count(?string $search = null): int
    {
        return $search
            ? $this->repository->countSearch($search)
            : $this->repository->countAll();
    }
}
