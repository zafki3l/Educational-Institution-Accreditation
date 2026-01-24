<?php

namespace App\Business\Modules\User;

use App\Business\Ports\UserRepositoryInterface;
use App\Domain\Entities\Models\User;

/**
 * This is the "Writer" service. It isolates all operations that change 
 * the database state. Keeping writes separate from reads makes the code cleaner
 * and more "Seperation of Concerns"
 */
class UserCommand
{
    public function __construct(private UserRepositoryInterface $repository) {}

    /**
     * @param User $user
     * @return int
     */
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

    /**
     * @param int $user_id
     * @param User $user
     * @return int
     */
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

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        $deleted_rows = $this->repository->deleteById($id);

        return $deleted_rows;
    }
}