<?php

namespace App\Business\Queries;

use App\Business\Ports\CriteriaRepositoryInterface;
use App\Domain\Exceptions\CriteriaException\CriteriaNotFoundException;

class CriteriaQuery
{
    public function __construct(private CriteriaRepositoryInterface $repository) {}

    public function filter(array $filter): array
    {
        return $this->repository->filter($filter);
    }

    public function findAll(): array
    {
        return $this->repository->allWithDepartment();
    }

    public function find(?string $search): array
    {
        return $this->repository->search($search);
    }
    
    public function findOrFail(string $id): array
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new CriteriaNotFoundException($id);
        }

        return $found[0];
    }

    public function count(): int
    {
        return $this->repository->countAll();
    }
}