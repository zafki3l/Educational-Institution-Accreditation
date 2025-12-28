<?php

namespace App\Presentation\Http\Requests\Milestone;

class CreateMilestoneRequest extends MilestoneRequest
{
    private string $id;

    public function __construct(array $input)
    {
        $this->id = trim($input['id']);
        $this->criteria_id = trim($input['criteria_id']);
        $this->name = trim($input['name']);
    }

    public function getId(): string {return $this->id;}
}