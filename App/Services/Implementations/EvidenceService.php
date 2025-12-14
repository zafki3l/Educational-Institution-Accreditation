<?php

namespace App\Services\Implementations;

use App\Exceptions\EvidenceException\EvidenceNotFoundException;
use App\Models\Evidence;
use App\Repositories\Sql\Interfaces\EvidenceRepositoryInterface;
use App\Services\Interfaces\EvidenceServiceInterface;
use App\Services\Interfaces\FileUploadServiceInterface;
use Core\Paginator;

class EvidenceService implements EvidenceServiceInterface
{
    public function __construct(private EvidenceRepositoryInterface $evidenceRepository,
                                private FileUploadServiceInterface $fileUploadService) {}

    public function list(?string $search, int $current_page, array $filter): array
    {
        $filter = $this->filterArray($filter);

        $total_records = $this->count($search);

        [$total_pages, $current_page, $start_from] = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page);

        $evidences = $this->findAll($start_from, Paginator::RESULT_PER_PAGE);
        
        if ($search) {
            $evidences = $this->find($search, $start_from, Paginator::RESULT_PER_PAGE);
        }
        
        if ($filter) {
            $evidences = $this->filterEvidences($start_from, Paginator::RESULT_PER_PAGE, $filter);
        }

        return [
            'evidences' => $evidences,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }
    
    public function create(array $request): void
    {
        $evidence = new Evidence();

        $evidence->setId($request['evidence_id'])
                ->setName($request['evidence_name'])
                ->setDecision($request['decision'])
                ->setDocumentDate($request['document_date'])
                ->setIssuePlace($request['issue_place'])
                ->setLink($this->fileUploadService->evidenceUpload());

        $this->evidenceRepository->create($evidence);
    }

    public function findById(string $evidence_id): array
    {
        $found = $this->evidenceRepository->findById($evidence_id);

        if (!$found) {
            throw new EvidenceNotFoundException($evidence_id);
        }

        return $found;
    }

    public function findAll(int $start_from, int $result_per_page): array
    {
        return $this->evidenceRepository->all($start_from, $result_per_page);
    }

    public function find(string $search, int $start_from, int $result_per_page): array
    {
        return $this->evidenceRepository->search($search, $start_from, $result_per_page);
    }

    public function findAllWithoutMilestone(): array
    {
        return $this->evidenceRepository->evidenceWithoutMilestone();
    }

    public function filterEvidences(int $start_from, int $result_per_page, array $filter): array
    {
        return $this->evidenceRepository->filter($start_from, $result_per_page, $filter);
    }

    public function evidenceMilestone(string $evidence_id): array
    {
        return $this->evidenceRepository->evidenceManyToManyMilestone($evidence_id);
    }

    public function update(string $evidence_id, array $request): void
    {
        $found = $this->findById($evidence_id);

        $evidence = new Evidence();

        $evidence->setName($request['evidence_name'])
                ->setDecision($request['decision'])
                ->setDocumentDate($request['document_date'])
                ->setIssuePlace($request['issue_place'])
                ->setLink($this->fileUploadService->evidenceUpload($found[0]['link']));

        $this->evidenceRepository->updateById($evidence_id, $evidence);
    }

    public function delete(string $evidence_id): void
    {
        $this->findOrFail($evidence_id);

        $this->evidenceRepository->deleteById($evidence_id);
    }

    public function addMilestone($evidence_id, $milestone_id): void
    {
        $this->evidenceRepository->linkMinestoneToEvidence($evidence_id, $milestone_id);
    }

    private function findOrFail(string $evidence_id): array
    {
        $found = $this->evidenceRepository->findById($evidence_id);

        return $found ? $found : throw new EvidenceNotFoundException($evidence_id);
    }

    private function filterArray(array $filter): array
    {
        // Return true values only
        return array_filter($filter, fn($value) => !empty($value));
    }

    public function count(?string $search = null): int
    {
        return $search 
            ? $this->evidenceRepository->countSearch($search) 
            : $this->evidenceRepository->countAll();
    }
}