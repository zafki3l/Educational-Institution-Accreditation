<?php

namespace App\Business\Grouping;

class MilestoneGrouping
{
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