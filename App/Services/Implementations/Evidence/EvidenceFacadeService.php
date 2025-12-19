<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Exceptions\EvidenceException\EvidenceNotFoundException;
use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;
use App\Models\Evidence;
use App\Repositories\Sql\Interfaces\EvidenceRepositoryInterface;
use App\Services\Interfaces\Evidence\EvidenceQueryServiceInterface;
use App\Services\Interfaces\EvidenceServiceInterface;
use App\Services\Interfaces\FileUploadServiceInterface;
use Core\Paginator;
use Traits\FilterHelperTrait;

/**
 *
 * High-level application service responsible for orchestrating
 * evidence-related use cases.
 *
 * This service acts as a Facade:
 * - Coordinates Query Services and Command Services
 * - Delegates logging and error handling to dedicated services
 * - Encapsulates complex workflows into simple public methods
 *
 * It hides internal business logic and interaction details from
 * controllers, providing a clean and stable interface for the
 * presentation layer.
 *
 * The Facade does NOT contain business rules or persistence logic.
 * Its sole responsibility is orchestration and flow control.
 */
class EvidenceFacadeService implements EvidenceServiceInterface
{
    use FilterHelperTrait;

    public function __construct(private EvidenceRepositoryInterface $evidenceRepository,
                                private FileUploadServiceInterface $fileUploadService,
                                private EvidenceQueryServiceInterface $evidenceQueryService) {}

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
    
    public function create(CreateEvidenceRequest $request): void
    {
        $evidence = new Evidence();

        $evidence->setId($request->getId())
                ->setName($request->getName())
                ->setDecision($request->getDecision())
                ->setDocumentDate($request->getDocumentDate())
                ->setIssuePlace($request->getIssuePlace())
                ->setLink($this->fileUploadService->evidenceUpload($request->getFile()));

        $this->evidenceRepository->create($evidence);
    }

    public function evidenceMilestone(string $evidence_id): array
    {
        return $this->evidenceRepository->evidenceManyToManyMilestone($evidence_id);
    }

    public function update(string $evidence_id, UpdateEvidenceRequest $request): void
    {
        $found = $this->findOrFail($evidence_id)->toArray();

        $evidence = new Evidence();

        $evidence->setName($request->getName())
                ->setDecision($request->getDecision())
                ->setDocumentDate($request->getDocumentDate())
                ->setIssuePlace($request->getIssuePlace())
                ->setLink($this->fileUploadService->evidenceUpload($request->getFile(), $found[0]['link']));

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

    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        return $this->evidenceQueryService->findAll($start_from, $result_per_page);
    }

    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        return $this->evidenceQueryService->find($search, $start_from, $result_per_page);
    }

    public function findAllWithoutMilestone(): EvidenceCollectionDTO
    {
        return $this->evidenceQueryService->findAllWithoutMilestone();
    }

    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO
    {
        return $this->evidenceQueryService->filterEvidences($start_from, $result_per_page, $filter);
    }

    public function findOrFail(string $evidence_id): EvidenceCollectionDTO
    {
        return $this->evidenceQueryService->findOrFail($evidence_id);
    }

    public function count(?string $search = null): int
    {
        return $this->evidenceQueryService->count($search);
    }
}