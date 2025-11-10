<?php

namespace App\Database\Models;

use DateTime;

class Evidence
{
    private string $id;
    private string $milestoneId;
    private string $name;
    private string $decision;
    private string $documentDate;
    private string $issuePlace;
    private string $link;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function getId(): string {return $this->id;}

	public function getMilestoneId(): string {return $this->milestoneId;}

	public function getName(): string {return $this->name;}

	public function getDecision(): string {return $this->decision;}

	public function getDocumentDate(): string {return $this->documentDate;}

	public function getIssuePlace(): string {return $this->issuePlace;}

	public function getLink(): string {return $this->link;}

	public function getCreatedAt(): DateTime {return $this->created_at;}

	public function getUpdatedAt(): DateTime {return $this->updated_at;}

	public function setId(string $id): self {$this->id = $id; return $this;}

	public function setMilestoneId(string $milestoneId): self {$this->milestoneId = $milestoneId; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}

	public function setDecision(string $decision): self {$this->decision = $decision; return $this;}

	public function setDocumentDate(string $documentDate): self {$this->documentDate = $documentDate; return $this;}

	public function setIssuePlace(string $issuePlace): self {$this->issuePlace = $issuePlace; return $this;}

	public function setLink(string $link): self {$this->link = $link; return $this;}

	public function setCreatedAt(DateTime $created_at): self {$this->created_at = $created_at; return $this;}

	public function setUpdatedAt(DateTime $updated_at): self {$this->updated_at = $updated_at; return $this;}	
}