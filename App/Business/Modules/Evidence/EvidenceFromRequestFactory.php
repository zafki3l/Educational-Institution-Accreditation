<?php

namespace App\Business\Modules\Evidence;

use App\Business\FileUpload\EvidenceFileUploadInterface;
use App\Domain\Entities\Builders\EvidenceBuilder;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByIdDTO;
use App\Domain\Entities\Models\Evidence;
use App\Presentation\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Presentation\Http\Requests\Evidence\UpdateEvidenceRequest;

/**
 * Converts "Request Data" into "Domain Objects."
 */
class EvidenceFromRequestFactory
{
    public function __construct(private EvidenceFileUploadInterface $fileUpload) {}

    /**
     * @param CreateEvidenceRequest $request
     * @return Evidence
     */
    public function fromCreateRequest(CreateEvidenceRequest $request): Evidence
    {
        return (new EvidenceBuilder())
                ->setId($request->getId())
                ->setName($request->getName())
                ->setDecision($request->getDecision())
                ->setDocumentDate($request->getDocumentDate())
                ->setIssuePlace($request->getIssuePlace())
                ->setLink($this->fileUpload->upload($request->getFile()))
                ->build();
    }

    /**
     * @param string $requested_id
     * @param EvidenceByIdDTO $data
     * @param UpdateEvidenceRequest $request
     * @return Evidence
     */
    public function fromUpdateRequest(string $requested_id, EvidenceByIdDTO $data, UpdateEvidenceRequest $request): Evidence
    {
        return (new EvidenceBuilder())
                ->setId($requested_id)
                ->setName($request->getName())
                ->setDecision($request->getDecision())
                ->setDocumentDate($request->getDocumentDate())
                ->setIssuePlace($request->getIssuePlace())
                ->setLink($this->fileUpload->upload($request->getFile(), $data->link))
                ->build();                 
    }
}