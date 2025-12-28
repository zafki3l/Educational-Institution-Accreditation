<?php 

namespace App\Presentation\Http\Requests\Criteria;

class CriteriaRequest
{
    protected string $standard_id;
    protected string $name;

    public function getStandardId(): string {return $this->standard_id;}

	public function getName(): string {return $this->name;}
}