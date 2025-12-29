<?php

namespace App\Business\FromRequestFactory;

use App\Domain\Entities\Builders\UserBuilder;
use App\Domain\Entities\Models\User;
use App\Presentation\Http\Requests\User\CreateUserRequest;
use App\Presentation\Http\Requests\User\UpdateUserRequest;

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