<?php

namespace App\Business\Modules\Criteria;

use App\Domain\Entities\Builders\CriteriaBuilder;
use App\Domain\Entities\Models\Criteria;
use App\Presentation\Http\Requests\Criteria\CreateCriteriaRequest;

/**
 * Converts "Request Data" into "Domain Objects."
 */
class CriteriaFromRequestFactory
{
    /**
     * @param CreateCriteriaRequest $request
     * @return Criteria
     */
    public function fromCreateRequest(CreateCriteriaRequest $request): Criteria
    {
        return (new CriteriaBuilder())
                ->setId($request->getId())
                ->setStandardId($request->getStandardId())
                ->setName($request->getName())
                ->build();
    }
}