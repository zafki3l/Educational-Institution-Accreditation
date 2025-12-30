<?php

namespace App\Business\Commands;

use App\Business\Ports\UserRepositoryInterface;
use App\Domain\Entities\Models\User;

/**
 * This service handles state-changing operations such as
 * creating, updating, and deleting users. 
 */
class UserCommand
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function create(User $user): int
    {
        $created_id = $this->repository->create([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'password' => $user->getPassword(),
            'department_id' => $user->getDepartmentId(),
            'role_id' => $user->getRoleId()
        ]);

        return $created_id;
    }

    public function update(int $user_id, User $user): int
    {
        $updated_id = $this->repository->updateById([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'department_id' => $user->getDepartmentId(),
            'role_id' => $user->getRoleId(),
            'user_id' => $user_id
        ]);

        return $updated_id;
    }

    public function delete(int $id): int
    {
        $deleted_rows = $this->repository->deleteById($id);

        return $deleted_rows;
    }
}