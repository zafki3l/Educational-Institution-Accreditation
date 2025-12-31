<?php

namespace App\Domain\Entities\Builders;

use App\Domain\Entities\Models\Criteria;

class CriteriaBuilder
{
    private string $id;
    private string $standard_id;
    private string $name;

    public function setId(string $id): self
	{
		$this->id = $id;
		return $this;
	}

	public function setStandardId(string $standard_id): self
	{
		$this->standard_id = $standard_id;
		return $this;
	}

	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

    public function build(): Criteria
    {
        return new Criteria($this->id, $this->standard_id, $this->name);
    }
}