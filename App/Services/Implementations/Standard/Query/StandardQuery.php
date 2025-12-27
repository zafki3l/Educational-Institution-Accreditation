<?php

namespace App\Services\Implementations\Standard\Query;

use App\Exceptions\StandardException\StandardNotFoundException;
use App\Repositories\Sql\Implementations\Standard\MysqlStandardRepository;

class StandardQuery
{
    public function __construct(private MysqlStandardRepository $repository) {}

    public function allWithDepartment(): array
    {
        return $this->repository->allWithDepartment();
    }

    public function findAll(): array
    {
        return $this->repository->all();
    }

    public function findOrFail(string $standard_id): array
    {
        $found = $this->repository->findById($standard_id);

        if (!$found) {
            throw new StandardNotFoundException($standard_id);
        }

        return $found;
    }

    public function count(): int
    {
        return $this->repository->countAll();
    }
}