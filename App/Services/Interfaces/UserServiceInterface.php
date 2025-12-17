<?php

namespace App\Services\Interfaces;

use App\DTO\UserDTO\UserByIdDTO;
use App\DTO\UserDTO\UserCollectionDTO;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;

interface UserServiceInterface
{
    public function list(?string $search, int $current_page): array;
    
    public function create(CreateUserRequest $request): void;
    
    public function update(int $user_id, UpdateUserRequest $request);
    
    public function delete(int $user_id): void;
    
    public function handleError(UserRequest $request, $isUpdated = false): ?array;
    
    public function findById(int $user_id): UserByIdDTO;
    
    public function findAll(int $start_from, int $result_per_page): UserCollectionDTO;
    
    public function find(string $search, int $start_from, int $result_per_page): UserCollectionDTO;

    public function count(?string $search = null): int;
}