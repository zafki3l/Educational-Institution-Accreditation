<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{
    public function list(?string $search, int $current_page): array;
    public function create(array $request): void;
    public function update(int $user_id, array $request);
    public function delete(int $user_id): void;
    public function handleError(array $request, $isUpdated = false): ?array;
    public function findById(int $user_id): array;
    public function findAll(int $start_from, int $result_per_page): array;
    public function find(string $search, int $start_from, int $result_per_page): array;
}