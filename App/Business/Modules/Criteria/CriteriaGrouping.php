<?php

namespace App\Business\Modules\Criteria;

/**
 * Raw database results are usually "flat," but the UI (like a report or form) 
 * often needs data organized by category. This service keeps that 
 * reorganizing logic out of your Controllers and Views.
 */
class CriteriaGrouping
{
    /**
     * @param array $criterias
     * @return array[]
     */
    public function groupByStandard(array $criterias): array
    {
        $grouping = [];

        foreach ($criterias as $criteria) {
            $standard_id = $criteria['standard_id'];
            $grouping[$standard_id][] = $criteria;
        }

        return $grouping;
    }
}