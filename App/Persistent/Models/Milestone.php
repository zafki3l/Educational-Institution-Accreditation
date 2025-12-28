<?php

namespace App\Persistent\Models;

use DateTime;

class Milestone
{
    private string $id;
    private string $criteria_id;
    private string $name;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function getId(): string {return $this->id;}

	public function getCriteriaId(): string {return $this->criteria_id;}

	public function getName(): string {return $this->name;}

	public function getCreatedAt(): DateTime {return $this->created_at;}

	public function getUpdatedAt(): DateTime {return $this->updated_at;}

	public function setId(string $id): self {$this->id = $id; return $this;}

	public function setCriteriaId(string $criteria_id): self {$this->criteria_id = $criteria_id; return $this;}

	public function setName(string $name): self {$this->name = $name; return $this;}

	public function setCreatedAt(DateTime $created_at): self {$this->created_at = $created_at; return $this;}

	public function setUpdatedAt(DateTime $updated_at): self {$this->updated_at = $updated_at; return $this;}
}