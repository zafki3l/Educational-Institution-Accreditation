<?php 

namespace App\Services\Implementations\Criteria;

use App\Domain\Exceptions\CriteriaException\CriteriaNotFoundException;
use App\Http\Requests\Criteria\CreateCriteriaRequest;
use App\Models\Criteria;
use App\Repositories\Sql\Implementations\Criteria\MySqlCriteriaRepository;
use App\Services\Implementations\Logging\LogService;

class CriteriaService
{
    public function __construct(private MySqlCriteriaRepository $criteriaRepository,
                                private LogService $logService){}

    public function list(?string $search, array $filter): array
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filter($filter);

        return $this->findAll();
    }

    public function create(CreateCriteriaRequest $request): void
    {
        $criteria = new Criteria();
        
        $criteria->setId($request->getId())
                ->setStandardId($request->getStandardId())
                ->setName($request->getName());

        $created = $this->criteriaRepository->create([
            'id' => $criteria->getId(),
            'standard_id' => $criteria->getStandardId(),
            'name' => $criteria->getName()
        ]);

        $isSuccess = $created ? true : false;

        $found = $this->findbyId($criteria->getId());

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm tiêu chí mới";

        $this->logService->createLog('criteria', $found, 'create', $message, $isSuccess);
    }

    public function delete(string $criteria_id): void
    {
        $found = $this->findById($criteria_id);

        $deleted = $this->criteriaRepository->deleteById($criteria_id);

        $isSuccess = $deleted ? true : false;

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa tiêu chí {$found['id']}";

        $this->logService->createLog('criteria', $found, 'delete', $message, $isSuccess);
    }

    public function filter(array $filter): array
    {
        return $this->criteriaRepository->filter($filter);
    }

    public function findAll(): array
    {
        return $this->criteriaRepository->allWithDepartment();
    }

    public function find(?string $search): array
    {
        return $this->criteriaRepository->search($search);
    }
    
    private function findById(string $criteria_id): array
    {
        $found = $this->criteriaRepository->findById($criteria_id);

        if (!$found) {
            throw new CriteriaNotFoundException($criteria_id);
        }

        return $found[0];
    }

    private function filterArray(array $filter): array
    {
        return array_filter($filter, function ($value) {
            return !empty($value);
        });
    }

    public function count(): int
    {
        return $this->criteriaRepository->countAll();
    }
}