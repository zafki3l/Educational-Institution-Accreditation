<?php

namespace App\Services;

use App\Models\Evidence;
use Core\Paginator;

class EvidenceService
{
    public function __construct(private Evidence $evidence) {}

    public function getAllEvidence(?string $search, int $current_page): array
    {
        $total_records = $search ? $this->evidence->countSearchEvidence($search) 
                                : $this->evidence->countAllEvidence();

        $pagination = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page); // Calculate the total pages and the start page

        $evidences = $search ? $this->evidence->searchEvidence($search, $pagination['start_from'], Paginator::RESULT_PER_PAGE) 
                            : $this->evidence->getAllEvidence($pagination['start_from'], Paginator::RESULT_PER_PAGE);

        return [
            'evidences' => $evidences,
            'current_page' => $current_page,
            'total_pages' => $pagination['total_pages'],
            'result_per_page' => Paginator::RESULT_PER_PAGE
        ];
    }
    
    public function createEvidence(array $request): void
    {
        $this->evidence->setId($request['evidence_id']);
        $this->evidence->setName($request['evidence_name']);
        $this->evidence->setMilestoneId($request['milestone_id']);
        $this->evidence->setDecision($request['decision']);
        $this->evidence->setDocumentDate($request['document_date']);
        $this->evidence->setIssuePlace($request['issue_place']);
        $this->evidence->setLink($request['link']);

        $this->evidence->createEvidence();
    }

    public function getEvidenceById(string $evidence_id): array
    {
        return $this->evidence->getEvidenceById($evidence_id);
    }

    public function updateEvidence(string $evidence_id, array $request): void
    {
        $this->evidence->setName($request['evidence_name']);
        $this->evidence->setMilestoneId($request['milestone_id']);
        $this->evidence->setDecision($request['decision']);
        $this->evidence->setDocumentDate($request['document_date']);
        $this->evidence->setIssuePlace($request['issue_place']);
        $this->evidence->setLink($request['link']);

        $this->evidence->updateEvidence($evidence_id);
    }

    public function deleteEvidence(string $evidence_id): void
    {
        $this->evidence->deleteEvidence($evidence_id);
    }
}