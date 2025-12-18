<?php

namespace App\Services\Interfaces\User;

use App\DTO\UserDTO\UserByIdDTO;
use App\DTO\UserDTO\UserCollectionDTO;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use MongoDB\InsertOneResult;

interface UserFacadeServiceInterface
{
    public function list(?string $search, int $current_page): array;
    
    public function create(CreateUserRequest $request): InsertOneResult;
    
    public function update(int $user_id, UpdateUserRequest $request): InsertOneResult;
    
    public function delete(int $user_id): InsertOneResult;
    
    public function handleError(UserRequest $request, $isUpdated = false): ?array;

    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO;

    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO;

    public function findOrFail(int $id): UserByIdDTO;

    public function count(?string $search = null): int;
}