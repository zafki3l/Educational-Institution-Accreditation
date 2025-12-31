<?php

namespace App\Domain\Entities\Models;

class Criteria
{
	public function __construct(private string $id,
								private string $standard_id,
								private string $name) {}

	public function getId(): string
	{
		return $this->id;
	}

	public function getStandardId(): string
	{
		return $this->standard_id;
	}

	public function getName(): string
	{
		return $this->name;
	}
}
