<?php

namespace App\Http\Requests\Criteria;

class CreateCriteriaRequest extends CriteriaRequest
{
    private string $id;

    public function __construct(array $input)
    {
        $this->id = trim($input['id']);
        $this->standard_id = trim($input['standard_id']);
        $this->name = trim($input['name']);
    }

    public function getId(): string {return $this->id;}
}