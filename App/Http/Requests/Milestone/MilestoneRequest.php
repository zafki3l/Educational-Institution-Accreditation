<?php

namespace App\Http\Requests\Milestone;

abstract class MilestoneRequest
{
    protected readonly string $criteria_id;
    protected readonly string $name;

    public function getCriteriaId(): string {return $this->criteria_id;}

	public function getName(): string {return $this->name;}
}