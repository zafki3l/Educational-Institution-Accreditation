<?php

namespace App\Domain\Entities\Builders;

use App\Domain\Entities\Models\Evidence;

class EvidenceBuilder
{
    private string $id;
    private string $name;
    private string $decision;
    private string $documentDate;
    private string $issuePlace;
    private string $link;

    public function setId(string $id): self {$this->id = $id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}

	public function setDecision(string $decision): self {$this->decision = $decision; return $this;}

	public function setDocumentDate(string $documentDate): self {$this->documentDate = $documentDate; return $this;}

	public function setIssuePlace(string $issuePlace): self {$this->issuePlace = $issuePlace; return $this;}

	public function setLink(string $link): self {$this->link = $link; return $this;}

    public function build(): Evidence
    {
        return new Evidence(
            $this->id,
            $this->name,
            $this->decision,
            $this->documentDate,
            $this->issuePlace,
            $this->link
        );
    }
}