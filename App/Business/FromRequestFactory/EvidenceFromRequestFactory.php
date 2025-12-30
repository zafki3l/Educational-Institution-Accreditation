<?php

namespace App\Business\FromRequestFactory;

use App\Business\FileUpload\EvidenceFileUploadInterface;
use App\Domain\Entities\Builders\EvidenceBuilder;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByIdDTO;
use App\Domain\Entities\Models\Evidence;
use App\Presentation\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Presentation\Http\Requests\Evidence\UpdateEvidenceRequest;

/**
 * Create new Evidence object from request
 * Example: CreateEvidenceRequest, UpdateEvidenceRequest
 */
class EvidenceFromRequestFactory
{
    public function __construct(private EvidenceFileUploadInterface $fileUpload) {}

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

    public function fromUpdateRequest(string $requested_id, EvidenceByIdDTO $data, UpdateEvidenceRequest $request): Evidence
    {
        $builder = new EvidenceBuilder();

        $evidence = $builder->setId($requested_id)
                            ->setName($request->getName())
                            ->setDecision($request->getDecision())
                            ->setDocumentDate($request->getDocumentDate())
                            ->setIssuePlace($request->getIssuePlace())
                            ->setLink($this->fileUpload->upload($request->getFile(), $data->link))
                            ->build();
                 
        return $evidence;
    }
}