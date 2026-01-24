<?php

namespace App\Business\Modules\Milestone;

/**
 * Raw database results are usually "flat," but the UI (like a report or form) 
 * often needs data organized by category. This service keeps that 
 * reorganizing logic out of your Controllers and Views.
 */
class MilestoneGrouping
{
    /**
     * @param array $milestones
     * @return array[]
     */
    public function groupByCriteria(array $milestones): array
    {
        $grouping = [];

        foreach ($milestones as $milestone) {
            $criteria_id = $milestone['criteria_id'];
            $grouping[$criteria_id][] = $milestone;
        }

        return $grouping;
    }
}