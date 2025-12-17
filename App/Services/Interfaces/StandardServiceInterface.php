<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\Standard\CreateStandardRequest;

interface StandardServiceInterface
{
    public function list(): array;
    
    public function findAll(): array;
    
    public function create(CreateStandardRequest $request): void;
    
    public function delete(string $id): void;

    public function count(): int;
}