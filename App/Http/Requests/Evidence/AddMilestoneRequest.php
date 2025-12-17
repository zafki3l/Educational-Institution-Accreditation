<?php

namespace App\Http\Requests\Evidence;

class AddMilestoneRequest extends EvidenceRequest
{
    private readonly string $milestone_id;

    public function __construct(array $input)
    {
        $this->milestone_id = trim($input['milestone_id']);
    }

    public function getMilestoneId(): string {return $this->milestone_id;}
}