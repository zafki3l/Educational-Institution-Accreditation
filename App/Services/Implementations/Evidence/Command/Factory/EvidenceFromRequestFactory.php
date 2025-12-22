<?php

namespace App\Services\Implementations\Evidence\Command\Factory;

use App\Entities\Models\Evidence;
use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;
use App\Services\Implementations\Evidence\EvidenceUpload\EvidenceFileUpload;

class EvidenceFromRequestFactory
{
    public function __construct(private EvidenceFileUpload $fileUpload) {}

    public function fromCreateRequest(CreateEvidenceRequest $request): Evidence
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

    public function fromUpdateRequest(array $found, UpdateEvidenceRequest $request): Evidence
    {
        $evidence = new Evidence();

        $evidence->setName($request->getName())
                 ->setDecision($request->getDecision())
                 ->setDocumentDate($request->getDocumentDate())
                 ->setIssuePlace($request->getIssuePlace())
                 ->setLink($this->fileUpload->upload($request->getFile(), $found[0]['link']));
                 
        return $evidence;
    }
}