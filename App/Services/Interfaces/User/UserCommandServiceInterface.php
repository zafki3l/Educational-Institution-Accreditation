<?php

namespace App\Services\Interfaces\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;

/**
 * This service handles state-changing operations such as
 * creating, updating, and deleting users. 
 */
interface UserCommandServiceInterface
{
    public function create(User $user): int;

    public function setCreateUser(CreateUserRequest $request): User;

    public function update(int $id, User $user): int;

    public function setUpdateUser(UpdateUserRequest $request): User;

    public function delete(int $id): int;
}