<?php 

namespace App\Services\Implementations;

use App\Models\Standard;
use App\Repositories\Interfaces\StandardRepositoryInterface;
use App\Services\Interfaces\StandardServiceInterface;

class StandardService implements StandardServiceInterface
{
    public function __construct(private Standard $standard,
                                private StandardRepositoryInterface $standardRepository) {}

    public function listStandards(): array
    {
        return $this->findAll();
    }

    public function findAll(): array
    {
        return $this->standardRepository->getAllStandard();
    }

    public function createStandard(array $request): void
    {
        $this->standard->setId($request['id'])
                        ->setName($request['name']);

        $this->standardRepository->createStandard($this->standard);
    }

    public function deleteStandard(string $id): void
    {
        $this->standardRepository->deleteStandard($id);
    }
}