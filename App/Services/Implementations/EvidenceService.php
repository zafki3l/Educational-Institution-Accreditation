<?php

namespace App\Services\Implementations;

use App\Database\Models\Evidence;
use App\Database\Repositories\Interfaces\EvidenceRepositoryInterface;
use App\Services\Interfaces\EvidenceServiceInterface as InterfacesEvidenceServiceInterface;
use Core\Paginator;

class EvidenceService implements InterfacesEvidenceServiceInterface
{
    public function __construct(private Evidence $evidence,
                                private EvidenceRepositoryInterface $evidenceRepository) {}

    public function listEvidences(?string $search, int $current_page): array
    {
        $total_records = $search ? $this->evidenceRepository->countSearchEvidence($search) 
                                : $this->evidenceRepository->countAllEvidence();

        [$total_pages, $current_page, $start_from] = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page);

        $evidences = $search ? $this->find($search, $start_from, Paginator::RESULT_PER_PAGE) 
                            : $this->findAll($start_from, Paginator::RESULT_PER_PAGE);

        return [
            'evidences' => $evidences,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }
    
    public function createEvidence(array $request): void
    {
        $this->evidence->setId($request['evidence_id'])
                        ->setName($request['evidence_name'])
                        ->setMilestoneId($request['milestone_id'])
                        ->setDecision($request['decision'])
                        ->setDocumentDate($request['document_date'])
                        ->setIssuePlace($request['issue_place'])
                        ->setLink($request['link']);

        $this->evidenceRepository->createEvidence($this->evidence);
    }

    public function getEvidenceById(string $evidence_id): array
    {
        return $this->evidenceRepository->getEvidenceById($evidence_id);
    }

    public function updateEvidence(string $evidence_id, array $request): void
    {
        $this->evidence->setName($request['evidence_name'])
                        ->setMilestoneId($request['milestone_id'])
                        ->setDecision($request['decision'])
                        ->setDocumentDate($request['document_date'])
                        ->setIssuePlace($request['issue_place'])
                        ->setLink($request['link']);

        $this->evidenceRepository->updateEvidence($evidence_id, $this->evidence);
    }

    public function deleteEvidence(string $evidence_id): void
    {
        $this->evidenceRepository->deleteEvidence($evidence_id);
    }

    public function findAll(int $start_from, int $result_per_page): array
    {
        return $this->evidenceRepository->getAllEvidence($start_from, $result_per_page);
    }

    public function find(string $search, int $start_from, int $result_per_page): array
    {
        return $this->evidenceRepository->searchEvidence($search, $start_from, $result_per_page);
    }
}