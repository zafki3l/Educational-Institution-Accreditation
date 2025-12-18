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

    public function create(CreateUserRequest $request): array
    {
        $user = new User();

        $user->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setEmail($request->getEmail())
            ->setGender($request->getGender())
            ->setPassword($request->getPassword())
            ->setDepartmentId($request->getDepartmentId())
            ->setRoleId($request->getRoleId());

        $created = $this->userRepository->create([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'department_id' => $user->getDepartmentId(),
            'role_id' => $user->getRoleId()
        ]);

        $data = $this->userQueryService->findById($created);

        return [
            'data' => $data->toArray(), 
            'isSuccess' => $created ? true : false
        ];
    }

    public function update(int $user_id, UpdateUserRequest $request): array
    {
        $found = $this->userQueryService->findById($user_id);

        $user = new User();

        $user->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setEmail($request->getEmail())
            ->setGender($request->getGender())
            ->setDepartmentId($request->getDepartmentId())
            ->setRoleId($request->getRoleId());

        $updated = $this->userRepository->updateById([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'gender' => $user->getGender(),
            'department_id' => $user->getDepartmentId(),
            'role_id' => $user->getRoleId(),
            'user_id' => $user_id
        ]);

        return [
            'data' => $found->toArray(), 
            'isSuccess' => $updated ? true : false
        ];
    }

    public function delete(int $id): array
    {
        $found = $this->userQueryService->findById($id);

        $deleted = $this->userRepository->deleteById($id);

        return [
            'data' => $found->toArray(),
            'isSuccess' => $deleted ? true : false
        ];
    }
}