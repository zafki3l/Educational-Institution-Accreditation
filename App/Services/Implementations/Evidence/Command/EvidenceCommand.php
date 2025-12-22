<?php 

namespace App\Services\Implementations\Evidence\Command;

use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;
use App\Models\Evidence;
use App\Repositories\Sql\EvidenceRepository;
use App\Services\Implementations\Evidence\FileUpload\EvidenceFileUpload;

class EvidenceCommand
{
    public function __construct(private EvidenceRepository $repository,
                                private EvidenceFileUpload $fileUpload) {}

    public function create(Evidence $evidence): int
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

    public function setCreate(CreateEvidenceRequest $request): Evidence
    {
        $evidence = new Evidence();

        $evidence->setId($request->getId())
                ->setName($request->getName())
                ->setDecision($request->getDecision())
                ->setDocumentDate($request->getDocumentDate())
                ->setIssuePlace($request->getIssuePlace())
                ->setLink($this->fileUpload->upload($request->getFile()));
        
        return $evidence;
    }

    public function update(string $id, Evidence $evidence): int
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

    public function setUpdate(array $found, UpdateEvidenceRequest $request): Evidence
    {
        $evidence = new Evidence();

        $evidence->setName($request->getName())
                ->setDecision($request->getDecision())
                ->setDocumentDate($request->getDocumentDate())
                ->setIssuePlace($request->getIssuePlace())
                ->setLink($this->fileUpload->upload($request->getFile(), $found[0]['link']));

        return $evidence;
    }

    public function delete(string $id): int
    {
        return $this->repository->deleteById($id);
    }

    public function addMilestone($id, $milestone_id): int
    {
        return $this->repository->linkMinestoneToEvidence($id, $milestone_id);
    }
}