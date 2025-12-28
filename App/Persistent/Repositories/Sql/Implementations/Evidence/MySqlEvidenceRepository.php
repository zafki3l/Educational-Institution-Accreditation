<?php

namespace App\Persistent\Repositories\Sql\Implementations\Evidence;

use App\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use Core\SqlRepository;
use PDOException;
use Traits\QueryClauseHelperTrait;

class MySqlEvidenceRepository extends SqlRepository
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
                        s.department_id as 'department_id',
                        e.created_at as 'created_at',
                        e.updated_at as 'updated_at'
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
                        es.department_id as 'department_id',
                        e.created_at as 'created_at',
                        e.updated_at as 'updated_at'
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

    public function create(array $evidence): int
    {
        try {
            return $this->insert('evidences', $evidence);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function linkMinestoneToEvidence(string $evidence_id, string $milestone_id): int
    {
        try {
            return $this->insert('milestone_evidence', [
                'milestone_id' => $milestone_id,
                'evidence_id' => $evidence_id
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
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

    public function evidenceManyToManyMilestone(string $evidence_id): array
    {
        try {
            $sql = "SELECT em.evidence_id as 'evidence_id',
                            e.name as 'evidence_name',
                            em.milestone_id as 'milestone_id',
                            m.name as 'milestone_name'
                    FROM evidences e
                    JOIN milestone_evidence em 
                        ON e.id = em.evidence_id
                    JOIN evaluation_milestones m
                        ON m.id = em.milestone_id 
                    WHERE e.id = ?"; 

            return $this->getByParams([$evidence_id], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function evidenceWithoutMilestone(): array
    {
        try {
            $sql = "SELECT e.id as 'evidence_id',
                            e.name as 'evidence_name'
                    FROM evidences e
                    LEFT JOIN milestone_evidence em 
                        ON e.id = em.evidence_id
                    LEFT JOIN evaluation_milestones m
                        ON m.id = em.milestone_id
                    WHERE m.id is NULL"; 

            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function updateById(string $id, array $evidence): string
    {   
        try {
            $sql = "UPDATE evidences
                    SET name = ?,
                        decision = ?,
                        document_date = ?,
                        issue_place = ?,
                        link = ?
                    WHERE id = ?";

            parent::update($sql, array_merge($evidence, ['where' => $id]));

            return $id;
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