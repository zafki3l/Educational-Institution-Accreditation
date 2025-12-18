<?php

namespace App\Services\Interfaces\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

interface UserCommandServiceInterface
{
    public function create(CreateUserRequest $request): array;

    public function update(int $id, UpdateUserRequest $request): array;

    public function delete(int $id): array;
}