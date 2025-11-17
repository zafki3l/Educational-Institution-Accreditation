<?php

namespace App\Http\Requests;

class MilestoneRequest
{
    public function createMilestone(): array
    {
        return [
            'id' => trim($_POST['id']),
            'criteria_id' => trim($_POST['criteria_id']),
            'name' => trim($_POST['name'])
        ];
    }
}