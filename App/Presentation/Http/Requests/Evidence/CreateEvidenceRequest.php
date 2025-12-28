<?php

namespace App\Presentation\Http\Requests\Evidence;

class CreateEvidenceRequest extends EvidenceRequest
{
    private string $id;

    public function __construct(array $input)
    {
        $this->id = trim($input['evidence_id']);
        $this->name = trim($input['evidence_name']);
        $this->decision = trim($input['decision']);
        $this->documentDate = trim($input['document_date']);
        $this->issuePlace = trim($input['issue_place']);
        $this->file = $_FILES['file'];
    }

    public function getId(): string {return $this->id;}
}