<?php

namespace App\Business\FromRequestFactory;

use App\Domain\Entities\Builders\CriteriaBuilder;
use App\Domain\Entities\Models\Criteria;
use App\Presentation\Http\Requests\Criteria\CreateCriteriaRequest;

class CriteriaFromRequestFactory
{
    public function fromCreateRequest(CreateCriteriaRequest $request): Criteria
    {
        $builder = new CriteriaBuilder();

        $criteria = $builder->setId($request->getId())
                            ->setStandardId($request->getStandardId())
                            ->setName($request->getName())
                            ->build();
        
        return $criteria;
    }
}