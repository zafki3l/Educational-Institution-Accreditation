<?php

namespace App\Business\FromRequestFactory;

use App\Domain\Entities\Builders\MilestoneBuilder;
use App\Domain\Entities\Models\Milestone;
use App\Presentation\Http\Requests\Milestone\CreateMilestoneRequest;

class MilestoneFromRequestFactory
{
    public function fromCreateRequest(CreateMilestoneRequest $request): Milestone
    {
        $builder = new MilestoneBuilder();

        return $builder
                ->setId($request->getId())
                ->setCriteriaId($request->getCriteriaId())
                ->setName($request->getName())
                ->build();
    }
}