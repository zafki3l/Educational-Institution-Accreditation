<?php

namespace App\Domain\Entities\Models;

class Milestone
{
	public function __construct(
		private string $id,
		private string $criteria_id,
		private string $name
	) {}


	public function getId(): string
	{
		return $this->id;
	}

	public function getCriteriaId(): string
	{
		return $this->criteria_id;
	}

	public function getName(): string
	{
		return $this->name;
	}
}
