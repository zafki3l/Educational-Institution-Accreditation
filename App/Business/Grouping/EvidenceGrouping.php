<?php

namespace App\Business\Grouping;

class EvidenceGrouping
{
    public function groupByCriteria(array $evidences): array
    {
        $grouping = [];

        foreach ($evidences as $evidence) {
            $criteria_id = $evidence['criteria_id'];
            $grouping[$criteria_id][] = $evidence;
        }

        return $grouping;
    }
}