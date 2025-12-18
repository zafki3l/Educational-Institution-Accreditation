<?php

namespace App\Services\Implementations\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\User\UserCommandServiceInterface;
use App\Services\Interfaces\User\UserQueryServiceInterface;

class UserCommandService implements UserCommandServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository,
                                private UserQueryServiceInterface $userQueryService) {}

    public function create(User $user): int
    {
        $created_id = $this->userRepository->create([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'department_id' => $user->getDepartmentId(),
            'role_id' => $user->getRoleId()
        ]);

        return $created_id;
    }

    public function setCreateUser(CreateUserRequest $request): User
    {
        $user = new User();

        $user->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setEmail($request->getEmail())
            ->setGender($request->getGender())
            ->setPassword($request->getPassword())
            ->setDepartmentId($request->getDepartmentId())
            ->setRoleId($request->getRoleId());
        
        return $user;
    }

    public function update(int $user_id, User $user): int
    {
        $updated_id = $this->userRepository->updateById([
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

    public function setUpdateUser(UpdateUserRequest $request): User
    {
        $user = new User();

        $user->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setEmail($request->getEmail())
            ->setGender($request->getGender())
            ->setDepartmentId($request->getDepartmentId())
            ->setRoleId($request->getRoleId());
        
        return $user;
    }

    public function delete(int $id): int
    {
        $deleted_rows = $this->userRepository->deleteById($id);

        return $deleted_rows;
    }
}