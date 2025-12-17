<?php

namespace App\Http\Requests\Evidence;

abstract class EvidenceRequest
{
    protected string $name;
    protected string $decision;
    protected string $documentDate;
    protected string $issuePlace;
    protected array $file;
    
	public function getName(): string {return $this->name;}

	public function getDecision(): string {return $this->decision;}

	public function getDocumentDate(): string {return $this->documentDate;}

	public function getIssuePlace(): string {return $this->issuePlace;}

	public function getFile(): array {return $this->file;}
}