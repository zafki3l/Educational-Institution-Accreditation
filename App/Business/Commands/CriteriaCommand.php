<?php

namespace App\Business\Commands;

use App\Business\Ports\CriteriaRepositoryInterface;
use App\Domain\Entities\Models\Criteria;

class CriteriaCommand
{
    public function __construct(private CriteriaRepositoryInterface $repository) {}

    public function create(Criteria $criteria): int
    {
        $created_id = $this->repository->create([
            'id' => $criteria->getId(),
            'standard_id' => $criteria->getStandardId(),
            'name' => $criteria->getName()
        ]);

        return $created_id;
    }

    public function delete(string $id): int
    {
        $deleted_rows = $this->repository->deleteById($id);

        return $deleted_rows;
    }
}