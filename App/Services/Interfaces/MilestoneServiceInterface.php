<?php

namespace App\Services\Interfaces;

interface MilestoneServiceInterface
{
    public function list(?string $search, array $filter): array;
    
    public function filter(array $filter): array;
    
    public function create(array $request): void;
    
    public function delete(string $milestone_id): void;
    
    public function findAll(): array;
    
    public function find(?string $search): array;
}