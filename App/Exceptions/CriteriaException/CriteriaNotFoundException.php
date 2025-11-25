<?php

namespace App\Exceptions\CriteriaException;

use App\Exceptions\BusinessException;

class CriteriaNotFoundException extends BusinessException
{
    public function __construct(string $criteria_id)
    {
        parent::__construct(
            "Criteria with ID $criteria_id not found",
            'CRITERIA_NOT_FOUND',
            404
        );

        $this->setMeta(['criteria_id' => $criteria_id]);
    }
}