<?php

namespace App\Domain\Entities\Builders;

use App\Domain\Entities\Models\Milestone;

class MilestoneBuilder
{
    private string $id;
    private string $criteria_id;
    private string $name;

    public function setId(string $id): self {$this->id = $id; return $this;}

	public function setCriteriaId(string $criteria_id): self {$this->criteria_id = $criteria_id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}

    public function build(): Milestone
    {
        return new Milestone(
            $this->id,
            $this->criteria_id,
            $this->name
        );
    }
}