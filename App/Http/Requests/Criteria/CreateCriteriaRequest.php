<?php

namespace App\Http\Requests\Criteria;

class CreateCriteriaRequest extends CriteriaRequest
{
    public function __construct(array $input)
    {
        $this->standard_id = trim($input['standard_id']);
        $this->name = trim($input['name']);
    }
}