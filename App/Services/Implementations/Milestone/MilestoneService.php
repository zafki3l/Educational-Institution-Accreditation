<?php

namespace App\Services\Implementations\Milestone;

use App\Domain\Exceptions\MilestoneException\MilestoneNotFoundException;
use App\Presentation\Http\Requests\Milestone\CreateMilestoneRequest;
use App\Persistent\Models\Milestone;
use App\Persistent\Repositories\Sql\Implementations\Milestone\MySqlMilestoneRepository;
use App\Services\Implementations\Logging\LogService;

class MilestoneService
{
    public function __construct(private MySqlMilestoneRepository $milestoneRepository,
                                private LogService $logService) {}

    public function list(?string $search, array $filter): array
    {
        $filter = $this->filterArray($filter);

        if ($search) return $this->find($search);

        if ($filter) return $this->filter($filter);

        return $this->findAll();
    }

    public function filter(array $filter): array
    {
        return $this->milestoneRepository->filter($filter);
    }

    public function findAll(): array
    {
        return $this->milestoneRepository->all();
    }

    public function find(?string $search): array
    {
        // TODO:
        return [];
    }

    public function create(CreateMilestoneRequest $request): void
    {
        $milestone = new Milestone();

        $milestone->setId($request->getId())
                    ->setCriteriaId($request->getCriteriaId())
                    ->setName($request->getName());
    
        $created = $this->milestoneRepository->create([
            'id' => $milestone->getId(),
            'criteria_id' => $milestone->getCriteriaId(),
            'name' => $milestone->getName()
        ]);

        $found = $this->findById($milestone->getId());

        $isSuccess = $created ? true : false;

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã thêm mốc đánh giá mới";

        $this->logService->createLog('milestone', $found, 'create', $message, $isSuccess);
    }

    public function delete(string $milestone_id): void
    {
        $found = $this->findById($milestone_id);
        
        $deleted = $this->milestoneRepository->deleteById($milestone_id);

        $isSuccess = $deleted ? true : false;

        $message = "Người dùng {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} đã xóa mốc đánh giá {$found['id']}";

        $this->logService->createLog('milestone', $found, 'delete', $message, $isSuccess);
    }

    private function findById(string $milestone_id): array
    {
        $found = $this->milestoneRepository->findById($milestone_id);

        if (!$found) {
            throw new MilestoneNotFoundException($milestone_id);
        }

        return $found[0];
    }

    private function filterArray(array $filter)
    {
        return array_filter($filter, function ($value) {
            return !empty($value);
        });
    }

    public function count(): int
    {
        return $this->milestoneRepository->countAll();
    }
}