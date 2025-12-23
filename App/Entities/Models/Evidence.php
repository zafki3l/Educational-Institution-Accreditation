<?php

namespace App\Entities\Models;

class Evidence
{
	public function __construct(private string $id,
								private string $name,
								private string $decision,
								private string $documentDate,
								private string $issuePlace,
								private string $link) {}	

    public function getId(): string {return $this->id;}

	public function getName(): string {return $this->name;}

	public function getDecision(): string {return $this->decision;}

	public function getDocumentDate(): string {return $this->documentDate;}

	public function getIssuePlace(): string {return $this->issuePlace;}

	public function getLink(): string {return $this->link;}
}