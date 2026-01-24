<?php

namespace App\Business\Modules\Standard;

use App\Domain\Entities\Builders\StandardBuilder;
use App\Domain\Entities\Models\Standard;
use App\Presentation\Http\Requests\Standard\CreateStandardRequest;

/**
 * Converts "Request Data" into "Domain Objects."
 */
class StandardFromRequestFactory
{
    /**
     * @param CreateStandardRequest $request
     * @return Standard
     */
    public function fromCreateRequest(CreateStandardRequest $request): Standard
    {
        return (new StandardBuilder())
            ->setId($request->getId())
            ->setName($request->getName())
            ->setDepartmentId($request->getDepartmentId())
            ->build();
    }
}