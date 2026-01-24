<?php

namespace App\Business\Modules\Evidence;

/**
 * Raw database results are usually "flat," but the UI (like a report or form) 
 * often needs data organized by category. This service keeps that 
 * reorganizing logic out of your Controllers and Views.
 */
class EvidenceGrouping
{
    /**
     * @param array $evidences
     * @return array[]
     */
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