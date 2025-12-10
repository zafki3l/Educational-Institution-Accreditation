<?php

namespace App\Repositories\Sql\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function all(int $start_from, int $result_per_page): array;
    
    public function findByEmail(string $email): array;
    
    public function findById(int $user_id): array;
    
    public function create(User $user): int;
    
    public function updateById(int $user_id, User $user): int;
    
    public function deleteById(int $user_id): int;
    
    public function search(mixed $search, $start_from, $result_per_page): array;
    
    public function countAll(): int;
    
    public function countSearch(string $search): int;
}