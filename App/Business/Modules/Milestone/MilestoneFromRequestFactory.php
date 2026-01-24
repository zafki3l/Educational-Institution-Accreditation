<?php

namespace App\Business\Modules\Milestone;

use App\Domain\Entities\Builders\MilestoneBuilder;
use App\Domain\Entities\Models\Milestone;
use App\Presentation\Http\Requests\Milestone\CreateMilestoneRequest;

/**
 * Converts "Request Data" into "Domain Objects."
 */
class MilestoneFromRequestFactory
{
    /**
     * @param CreateMilestoneRequest $request
     * @return Milestone
     */
    public function fromCreateRequest(CreateMilestoneRequest $request): Milestone
    {
        return (new MilestoneBuilder())
                ->setId($request->getId())
                ->setCriteriaId($request->getCriteriaId())
                ->setName($request->getName())
                ->build();
    }
}