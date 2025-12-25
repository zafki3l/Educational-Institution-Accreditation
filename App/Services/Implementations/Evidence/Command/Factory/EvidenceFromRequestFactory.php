<?php

namespace App\Services\Implementations\Evidence\Command\Factory;

use App\Entities\Builders\EvidenceBuilder;
use App\Entities\Models\Evidence;
use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;
use App\Services\Implementations\Evidence\EvidenceUpload\EvidenceFileUpload;

/**
 * Create new Evidence object from request
 * Example: CreateEvidenceRequest, UpdateEvidenceRequest
 */
class EvidenceFromRequestFactory
{
    public function __construct(private EvidenceFileUpload $fileUpload) {}

    public function fromCreateRequest(CreateEvidenceRequest $request): Evidence
    {
        $builder = new EvidenceBuilder();

        $evidence = $builder->setId($request->getId())
                            ->setName($request->getName())
                            ->setDecision($request->getDecision())
                            ->setDocumentDate($request->getDocumentDate())
                            ->setIssuePlace($request->getIssuePlace())
                            ->setLink($this->fileUpload->upload($request->getFile()))
                            ->build();

        return $evidence;
    }

    public function fromUpdateRequest(string $requested_id, array $data, UpdateEvidenceRequest $request): Evidence
    {
        $builder = new EvidenceBuilder();

        $evidence = $builder->setId($requested_id)
                            ->setName($request->getName())
                            ->setDecision($request->getDecision())
                            ->setDocumentDate($request->getDocumentDate())
                            ->setIssuePlace($request->getIssuePlace())
                            ->setLink($this->fileUpload->upload($request->getFile(), $data[0]['link']))
                            ->build();
                 
        return $evidence;
    }
}