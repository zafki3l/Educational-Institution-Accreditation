<?php

namespace App\Database\Repositories;

use App\Database\Models\Evidence;
use Configs\Database;
use Core\Repository;
use PDOException;

class EvidenceRepository extends Repository
{
    public function __construct(Database $db,
                                private Evidence $evidence)
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
                'id' => $this->evidence->getId(),
                'milestone_id' => $this->evidence->getMilestoneId(),
                'name' => $this->evidence->getName(),
                'decision' => $this->evidence->getDecision(),
                'document_date' => $this->evidence->getDocumentDate(),
                'issue_place' => $this->evidence->getIssuePlace(),
                'link' => $this->evidence->getLink()
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
                'name' => $this->evidence->getName(),
                'milestone_id' => $this->evidence->getMilestoneId(),
                'decision' => $this->evidence->getDecision(),
                'document_date' => $this->evidence->getDocumentDate(),
                'issue_place' => $this->evidence->getIssuePlace(),
                'link' => $this->evidence->getLink(),
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
}