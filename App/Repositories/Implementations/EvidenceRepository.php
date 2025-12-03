<?php

namespace App\Repositories\Implementations;

use App\Models\Evidence;
use App\Repositories\Interfaces\EvidenceRepositoryInterface;
use Configs\Database\Interfaces\DatabaseInterface;
use Core\Repository;
use PDOException;
use Traits\QueryClauseHelperTrait;

class EvidenceRepository extends Repository implements EvidenceRepositoryInterface
{
    use QueryClauseHelperTrait;

    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function all(int $start_from, int $result_per_page): array
    {
        try {
            $sql = "SELECT e.id as 'evidence_id',
                        e.name as 'evidence_name',
                        em.name as 'evaluation_milestone',
                        e.decision,
                        e.document_date,
                        e.issue_place,
                        e.link,
                        s.department_id as 'department_id'
                    FROM evidences e
                    JOIN milestone_evidence me
                        ON me.evidence_id = e.id
                    JOIN evaluation_milestones em
                        ON em.id = me.milestone_id
                    JOIN evaluation_criterias c
                        ON c.id = em.criteria_id
                    JOIN evaluation_standards s
                        ON c.standard_id = s.id
                    LIMIT $start_from, $result_per_page";
        
            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function filter(int $start_from, int $result_per_page, array $filter): array
    {
        try {
            $columns = [
                'standard_id' => 'es.id',
                'criteria_id' => 'c.id',
                'milestone_id' => 'em.id'
            ];

            $clause = $this->buildWhereClause($filter, $columns);

            $sql = "SELECT e.id as 'evidence_id',
                        e.name as 'evidence_name',
                        em.name as 'evaluation_milestone',
                        e.decision,
                        e.document_date,
                        e.issue_place,
                        e.link,
                        es.department_id as 'department_id'
                    FROM evidences e
                    JOIN milestone_evidence me
                        ON me.evidence_id = e.id
                    JOIN evaluation_milestones em
                        ON em.id = me.milestone_id
                    JOIN evaluation_criterias c
                        ON c.id = em.criteria_id
                    JOIN evaluation_standards es
                        ON c.standard_id = es.id";
            $sql .= $this->bindWhereClause($clause['where']);
            $sql .= $this->bindLimitClause($start_from, $result_per_page);
        
            return $this->getByParams($clause['params'], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function countAll(): int
    {
        try {
            $data = $this->getAll("SELECT COUNT(id) as 'total' FROM evidences");

            return $data[0]['total'];
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function create(Evidence $evidence): void
    {
        try {
            $this->insert('evidences', [
                'id' => $evidence->getId(),
                'name' => $evidence->getName(),
                'decision' => $evidence->getDecision(),
                'document_date' => $evidence->getDocumentDate(),
                'issue_place' => $evidence->getIssuePlace(),
                'link' => $evidence->getLink()
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    public function findById(string $evidence_id): array
    {   
        try {
            $sql = "SELECT * FROM evidences WHERE id = ?"; 

            return $this->getByParams([$evidence_id], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function updateById(string $evidence_id, Evidence $evidence): int
    {   
        try {
            $sql = "UPDATE evidences
                    SET name = ?,
                        decision = ?,
                        document_date = ?,
                        issue_place = ?,
                        link = ?
                    WHERE id = ?";

            return parent::update($sql, [
                'name' => $evidence->getName(),
                'decision' => $evidence->getDecision(),
                'document_date' => $evidence->getDocumentDate(),
                'issue_place' => $evidence->getIssuePlace(),
                'link' => $evidence->getLink(),
                'where' => $evidence_id
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function deleteById(string $evidence_id): int
    {
        try {
            return parent::delete("DELETE FROM evidences WHERE id = ?", [$evidence_id]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function search(string $search, int $start_from, int $result_per_page): array
    {
        // TODO:
        return [];
    }

    public function countSearch(string $search): int
    {
        // TODO:
        return 0;
    }
}