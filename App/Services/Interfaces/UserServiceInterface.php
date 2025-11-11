<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{
    public function listUsers(?string $search, int $current_page): array;
    public function createUser(array $request): void;
    public function updateUser(int $user_id, array $request);
    public function deleteUser(int $user_id): void;
    public function handleError(array $request, $isUpdated = false): ?array;
    public function findById(int $user_id): array;
    public function findAll(int $start_from, int $result_per_page): array;
    public function find(string $search, int $start_from, int $result_per_page): array;
}