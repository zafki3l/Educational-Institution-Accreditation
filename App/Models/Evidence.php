<?php

namespace App\Models;

use Configs\Database;
use Core\Model;
use DateTime;
use PDOException;

class Evidence extends Model
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

    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function getAllEvidence(int $start_from, int $result_per_page): array
    {
        try {
            $sql = "SELECT e.id as 'evidence_id',
                        e.name as 'evidence_name',
                        em.name as 'evaluation_milestone',
                        e.decision,
                        e.document_date,
                        e.issue_place,
                        e.link
                    FROM evidences e
                    JOIN evaluation_milestones em
                        ON e.milestone_id = em.id
                    LIMIT $start_from, $result_per_page";
        
            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function countAllEvidence(): int
    {
        try {
            $data = $this->getAll("SELECT COUNT(id) as 'total' FROM evidences");

            return $data[0]['total'];
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function createEvidence(): void
    {
        try {
            $this->insert('evidences', [
                'id' => $this->id,
                'milestone_id' => $this->milestoneId,
                'name' => $this->name,
                'decision' => $this->decision,
                'document_date' => $this->documentDate,
                'issue_place' => $this->issuePlace,
                'link' => $this->issuePlace
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function getEvidenceById(string $evidence_id): array
    {   
        try {
            $sql = "SELECT * FROM evidences WHERE id = ?"; 

            return $this->getByParams([$evidence_id], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function updateEvidence(string $evidence_id): void
    {   
        try {
            $sql = "UPDATE evidences
                    SET name = ?,
                        milestone_id = ?,
                        decision = ?,
                        document_date = ?,
                        issue_place = ?,
                        link = ?
                    WHERE id = ?";

            $this->update($sql, [
                'name' => $this->name,
                'milestone_id' => $this->milestoneId,
                'decision' => $this->decision,
                'document_date' => $this->documentDate,
                'issue_place' => $this->issuePlace,
                'link' => $this->link,
                'where' => $evidence_id
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function deleteEvidence(string $evidence_id): void
    {
        try {
            $this->delete("DELETE FROM evidences WHERE id = ?", [$evidence_id]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function searchEvidence(string $search, int $start_from, int $result_per_page): array
    {
        // TODO:
        return [];
    }

    public function countSearchEvidence(string $search): int
    {
        // TODO:
        return 0;
    }

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