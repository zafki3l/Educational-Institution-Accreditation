<?php

namespace App\Models;

use Configs\Database;
use Core\Model;
use DateTime;

class Evidence extends Model
{
    private string $id;
    private string $evaluation_point_id;
    private string $name;
    private string $documentDate;
    private string $issuePlace;
    private string $link;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function __construct(Database $db)
    {
        parent::__construct($db);
    }
    public function getAllEvidence($start_from, $result_per_page): array
    {
        // TODO:
        return [];
    }

    public function getId(): string {return $this->id;}

	public function getEvaluationPointId(): string {return $this->evaluation_point_id;}

	public function getName(): string {return $this->name;}

	public function getDocumentDate(): string {return $this->documentDate;}

	public function getIssuePlace(): string {return $this->issuePlace;}

	public function getLink(): string {return $this->link;}

	public function getCreatedAt(): DateTime {return $this->created_at;}

	public function getUpdatedAt(): DateTime {return $this->updated_at;}

	public function setId(string $id): void {$this->id = $id;}

	public function setEvaluationPointId(string $evaluation_point_id): void {$this->evaluation_point_id = $evaluation_point_id;}

	public function setName(string $name): void {$this->name = $name;}

	public function setDocumentDate(string $documentDate): void {$this->documentDate = $documentDate;}

	public function setIssuePlace(string $issuePlace): void {$this->issuePlace = $issuePlace;}

	public function setLink(string $link): void {$this->link = $link;}

	public function setCreatedAt(DateTime $created_at): void {$this->created_at = $created_at;}

	public function setUpdatedAt(DateTime $updated_at): void {$this->updated_at = $updated_at;}
}