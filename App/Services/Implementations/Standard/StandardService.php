<?php 

namespace App\Services\Implementations\Standard;

use App\Exceptions\StandardException\StandardNotFoundException;
use App\Http\Requests\Standard\CreateStandardRequest;
use App\Models\Standard;
use App\Repositories\Sql\Implementations\Standard\MysqlStandardRepository;
use App\Services\Implementations\Logging\LogService;

class StandardService
{
    public function __construct(private MysqlStandardRepository $standardRepository,
                                private LogService $logService) {}

    public function list(): array
    {
        return $this->standardRepository->allWithDepartment();
    }

    public function findAll(): array
    {
        return $this->standardRepository->all();
    }

    public function create(CreateStandardRequest $request): void
    {
        $standard = new Standard();
        
        $standard->setId($request->getId())
                ->setName($request->getName())
                ->setDepartmentId($request->getDepartmentId());

        $created = $this->standardRepository->create([
            'id' => $standard->getId(),
            'name' => $standard->getName(),
            'department_id' => $standard->getDepartmentId()
        ]);

        $isSuccess = $created ? true : false;

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm 1 tiêu chuẩn mới";

        $this->logService->createLog('standard', $created, 'create', $message, $isSuccess);
    }

    public function delete(string $standard_id): void
    {
        $found = $this->findById($standard_id);

        $deleted = $this->standardRepository->deleteById($standard_id);

        $isSuccess = $deleted ? true : false;
        
        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa tiêu chuẩn {$found[0]['id']}";

        $this->logService->createLog('standard', $found, 'delete', $message, $isSuccess);
    }

    private function findById(string $standard_id): array
    {
        $found = $this->standardRepository->findById($standard_id);

        if (!$found) {
            throw new StandardNotFoundException($standard_id);
        }

        return $found;
    }

    public function count(): int
    {
        return $this->standardRepository->countAll();
    }
}