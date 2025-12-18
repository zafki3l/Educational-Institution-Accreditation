<?php

namespace App\Http\Requests\Milestone;

abstract class MilestoneRequest
{
    protected string $criteria_id;
    protected string $name;

    public function getCriteriaId(): string {return $this->criteria_id;}

	public function getName(): string {return $this->name;}
}