<?php 

namespace App\Business\Modules\Evidence;

use App\Business\Ports\EvidenceRepositoryInterface;
use App\Domain\Entities\Models\Evidence;

/**
 * This is the "Writer" service. It isolates all operations that change 
 * the database state. Keeping writes separate from reads makes the code cleaner
 * and more "Seperation of Concerns"
 */
class EvidenceCommand
{
    public function __construct(private EvidenceRepositoryInterface $repository) {}

    /**
     * @param Evidence $evidence
     * @return int
     */
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

    /**
     * @param string $id
     * @param Evidence $evidence
     * @return string
     */
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

    /**
     * @param string $id
     * @return int
     */
    public function delete(string $id): string
    {
        return $this->repository->deleteById($id);
    }

    /**
     * @param mixed $id
     * @param mixed $milestone_id
     * @return int
     */
    public function addMilestone($id, $milestone_id): string
    {
        return $this->repository->linkMinestoneToEvidence($id, $milestone_id);
    }
}