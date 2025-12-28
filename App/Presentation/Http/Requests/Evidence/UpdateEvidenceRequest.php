<?php

namespace App\Presentation\Http\Requests\Evidence;

class UpdateEvidenceRequest extends EvidenceRequest
{
    public function __construct(array $input)
    {
        $this->name = trim($input['evidence_name']);
        $this->decision = trim($input['decision']);
        $this->documentDate = trim($input['document_date']);
        $this->issuePlace = trim($input['issue_place']);
        $this->file = $_FILES['file'];
    }
}