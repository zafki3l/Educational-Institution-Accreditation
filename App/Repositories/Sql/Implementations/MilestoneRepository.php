<?php

namespace App\Repositories\Sql\Implementations;

use App\Repositories\Sql\Interfaces\MilestoneRepositoryInterface;
use Configs\Database\Interfaces\Core\DatabaseInterface;
use Core\SqlRepository;
use PDOException;
use Traits\QueryClauseHelperTrait;

class MilestoneRepository extends SqlRepository implements MilestoneRepositoryInterface
{
    use QueryClauseHelperTrait;

    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function all(): array
    {
        try {
            $sql = "SELECT em.id as 'id',
                            em.criteria_id as 'criteria_id',
                            em.name as 'name',
                            em.created_at as 'created_at',
                            em.updated_at as 'updated_at'
                    FROM evaluation_milestones em";
            
            return $this->getAll($sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function filter(array $filter): array
    {
        try {
            $columns = [
                'standard_id' => 'es.id',
                'criteria_id' => 'ec.id'
            ];

            $clause = $this->buildWhereClause($filter, $columns);

            $sql = "SELECT em.id as 'id',
                            em.criteria_id as 'criteria_id',
                            em.name as 'name',
                            em.created_at as 'created_at',
                            em.updated_at as 'updated_at'
                    FROM evaluation_milestones em 
                    JOIN evaluation_criterias ec 
                        ON em.criteria_id = ec.id
                    JOIN evaluation_standards es
                        ON ec.standard_id = es.id";
            $sql .= $this->bindWhereClause($clause['where']);
            
            return $this->getByParams($clause['params'], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function findById(string $milestone_id): array
    {
        try {
            $sql = "SELECT * FROM evaluation_milestones WHERE id = ?"; 

            return $this->getByParams([$milestone_id], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function create(array $milestone): string
    {
        try{
            return $this->insert('evaluation_milestones', $milestone);
        } catch (PDOException $e) {
            print $e->getMessage();
            return '';
        } 
    }

    public function deleteById(string $milestone_id): int
    {
        try {
            return $this->delete("DELETE FROM evaluation_milestones WHERE id = ?", [$milestone_id]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    public function countAll(): int
    {
        try {
            $results = $this->getAll("SELECT count(id) as 'results' from evaluation_milestones");
            return $results[0]['results'];
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }
}