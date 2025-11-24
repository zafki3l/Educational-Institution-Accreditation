<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllUser(int $start_from, int $result_per_page): array;
    public function getUserByEmail(string $email): array;
    public function getUserById(int $user_id): array;
    public function createUser(User $user): int;
    public function updateUserById(int $user_id, User $user): int;
    public function deleteUser(int $user_id): int;
    public function searchUser(mixed $search, $start_from, $result_per_page): array;
    public function countUser(): int;
    public function countSearchUser(string $search): int;
}