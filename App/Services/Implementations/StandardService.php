<?php 

namespace App\Services\Implementations;

use App\Exceptions\StandardException\StandardNotFoundException;
use App\Models\Standard;
use App\Repositories\Interfaces\StandardRepositoryInterface;
use App\Services\Interfaces\StandardServiceInterface;

class StandardService implements StandardServiceInterface
{
    public function __construct(private StandardRepositoryInterface $standardRepository) {}

    public function list(): array
    {
        return $this->standardRepository->allWithDepartment();
    }

    public function findAll(): array
    {
        return $this->standardRepository->all();
    }

    public function create(array $request): void
    {
        $standard = new Standard();
        
        $standard->setId($request['id'])
                        ->setName($request['name']);

        $this->standardRepository->create($standard);
    }

    public function delete(string $standard_id): void
    {
        $this->findOrFail($standard_id);

        $this->standardRepository->deleteById($standard_id);
    }

    private function findOrFail(string $standard_id): void
    {
        $found = $this->standardRepository->findById($standard_id);

        if (!$found) {
            throw new StandardNotFoundException($standard_id);
        }
    }
}