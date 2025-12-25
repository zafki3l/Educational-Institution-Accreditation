<?php

namespace App\Services\Implementations\User\Command\Factory;

use App\Entities\Builders\UserBuilder;
use App\Entities\Models\User;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

/**
 * Create new User object from request
 * Example: CreateUserRequest, UpdateUserRequest
 */
class UserFromRequestFactory
{
    public function fromCreateRequest(CreateUserRequest $request): User
    {
        $builder = new UserBuilder();

        $user = $builder->setId(null)
                        ->setFirstName($request->getFirstName())
                        ->setLastName($request->getLastName())
                        ->setEmail($request->getEmail())
                        ->setGender($request->getGender())
                        ->setPassword(password_hash($request->getPassword(), PASSWORD_DEFAULT))
                        ->setDepartmentId($request->getDepartmentId())
                        ->setRoleId($request->getRoleId())
                        ->build();

        return $user;
    }

    public function fromUpdateRequest(int $requested_id, UpdateUserRequest $request): User
    {
        $builder = new UserBuilder();

        $user = $builder->setId($requested_id)
                        ->setFirstName($request->getFirstName())
                        ->setLastName($request->getLastName())
                        ->setEmail($request->getEmail())
                        ->setGender($request->getGender())
                        ->setPassword(null)
                        ->setDepartmentId($request->getDepartmentId())
                        ->setRoleId($request->getRoleId())
                        ->build();
        
        return $user;
    }
}