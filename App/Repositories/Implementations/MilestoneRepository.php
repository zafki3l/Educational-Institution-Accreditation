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

    public function getMilestonesByCriteria(string $criteria_id): array
    {
        try{
            $sql = "SELECT * FROM evaluation_milestones
                    WHERE criteria_id = ?";
            
            return $this->getByParams([$criteria_id], $sql);
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