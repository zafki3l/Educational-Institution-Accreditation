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

	public function setId(string $id): void {$this->id = $id;}

	public function setMilestoneId(string $milestoneId): void {$this->milestoneId = $milestoneId;}

	public function setName(string $name): void {$this->name = $name;}

	public function setDecision(string $decision): void {$this->decision = $decision;}

	public function setDocumentDate(string $documentDate): void {$this->documentDate = $documentDate;}

	public function setIssuePlace(string $issuePlace): void {$this->issuePlace = $issuePlace;}

	public function setLink(string $link): void {$this->link = $link;}

	public function setCreatedAt(DateTime $created_at): void {$this->created_at = $created_at;}

	public function setUpdatedAt(DateTime $updated_at): void {$this->updated_at = $updated_at;}	
}