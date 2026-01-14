<?php

namespace App\Business\Grouping;

class CriteriaGrouping
{
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