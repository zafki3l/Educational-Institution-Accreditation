<?php

namespace App\Exceptions\MilestoneException;

use App\Exceptions\BusinessException;

class MilestoneNotFoundException extends BusinessException
{
    public function __construct(string $milestone_id)
    {
        parent::__construct(
            "Milestone with id $milestone_id not found", 
            'MILESTONE_NOT_FOUND',
            '404'
        );

        $this->setMeta(['milestone_id' => $milestone_id]);
    }
}