<?php

namespace App\Repositories\Implementations;

use App\Models\Milestone;
use App\Repositories\Interfaces\MilestoneRepositoryInterface;
use Configs\Database\Interfaces\DatabaseInterface;
use Core\Repository;
use PDOException;

class MilestoneRepository extends Repository implements MilestoneRepositoryInterface
{
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct($db);
    }

    public function getAllMilestones(): array
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

    public function filterMilestones(?string $standard_id, ?string $criteria_id): array
    {
        try {
            $sql = "SELECT em.id as 'id',
                            em.criteria_id as 'criteria_id',
                            em.name as 'name',
                            em.created_at as 'created_at',
                            em.updated_at as 'updated_at'
                    FROM evaluation_milestones em 
                    JOIN evaluation_criterias ec 
                        ON em.criteria_id = ec.id
                    JOIN evaluation_standards es
                        ON ec.standard_id = es.id
                    WHERE ec.id = ? AND es.id = ?";
            
            return $this->getByParams([$criteria_id, $standard_id], $sql);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function createMilestone(Milestone $milestone): void
    {
        try{
            $this->insert('evaluation_milestones', [
                'id' => $milestone->getId(),
                'criteria_id' => $milestone->getCriteriaId(),
                'name' => $milestone->getName()
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
        } 
    }

    public function deleteMilestone(string $milestone_id): void
    {
        try {
            $this->delete("DELETE FROM evaluation_milestones WHERE id = ?", [$milestone_id]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}