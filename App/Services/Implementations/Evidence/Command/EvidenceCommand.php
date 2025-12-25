<?php 

namespace App\Services\Implementations\Evidence\Command;

use App\Entities\Models\Evidence;
use App\Repositories\Sql\Implementations\Evidence\MySqlEvidenceRepository;

class EvidenceCommand
{
    public function __construct(private MySqlEvidenceRepository $repository) {}

    public function create(Evidence $evidence): string
    {
        $created_id = $this->repository->create([
            'id' => $evidence->getId(),
            'name' => $evidence->getName(),
            'decision' => $evidence->getDecision(),
            'document_date' => $evidence->getDocumentDate(),
            'issue_place' => $evidence->getIssuePlace(),
            'link' => $evidence->getLink()
        ]);

        return $created_id;
    }

    public function update(string $id, Evidence $evidence): string
    {
        $updated_id = $this->repository->updateById($id, [
            'name' => $evidence->getName(),
            'decision' => $evidence->getDecision(),
            'document_date' => $evidence->getDocumentDate(),
            'issue_place' => $evidence->getIssuePlace(),
            'link' => $evidence->getLink(),
        ]);

        return $updated_id;
    }

    public function delete(string $id): string
    {
        return $this->repository->deleteById($id);
    }

    public function addMilestone($id, $milestone_id): string
    {
        return $this->repository->linkMinestoneToEvidence($id, $milestone_id);
    }
}