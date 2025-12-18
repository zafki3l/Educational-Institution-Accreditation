<?php

namespace App\Services\Implementations\User;

use App\DTO\UserDTO\UserByIdDTO;
use App\DTO\UserDTO\UserCollectionDTO;
use App\DTO\UserDTO\UserListDTO;
use App\Exceptions\UserException\UserNotFoundException;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\User\UserQueryServiceInterface;
use DateTimeImmutable;

class UserQueryService implements UserQueryServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->userRepository->all($start_from, $result_per_page);

        return $this->dtoMapper($users);
    }

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO
    {
        $users = $this->userRepository->search($search, $start_from, $result_per_page);

        return $this->dtoMapper($users);
    }

    public function findById(int $id): UserByIdDTO
    {
        $found = $this->userRepository->findById($id);

        if (!$found) {
            throw new UserNotFoundException($id);
        }

        return new UserByIdDTO(
            $found[0]['id'],
            $found[0]['first_name'],
            $found[0]['last_name'],
            $found[0]['email'],
            $found[0]['gender'],
            $found[0]['role_id'],
            $found[0]['department_id']
        );
    }

    public function count(?string $search = null): int
    {
        return $search 
            ? $this->userRepository->countSearch($search) 
            : $this->userRepository->countAll();
    }

    private function dtoMapper(array $users): UserCollectionDTO
    {
        $userCollection = new UserCollectionDTO();

        foreach ($users as $userDto) {
            $userCollection->append(new UserListDTO(
                $userDto['id'],
                $userDto['first_name'],
                $userDto['last_name'],
                $userDto['email'],
                $userDto['gender'],
                $userDto['department_name'],
                $userDto['role_name'],
                new DateTimeImmutable($userDto['created_at']),
                new DateTimeImmutable($userDto['updated_at'])
            ));
        }

        return $userCollection;
    }
}