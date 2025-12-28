<?php

namespace App\Services\Implementations\Standard\Command\Factory;

use App\Domain\Entities\Builders\StandardBuilder;
use App\Domain\Entities\Models\Standard;
use App\Http\Requests\Standard\CreateStandardRequest;

/**
 * Create new Standard object from request
 */
class StandardFromRequestFactory
{
    public function fromCreateRequest(CreateStandardRequest $request): Standard
    {
        $builder = new StandardBuilder();

        $standard = $builder->setId($request->getId())
                            ->setName($request->getName())
                            ->setDepartmentId($request->getDepartmentId())
                            ->build();
        
        return $standard;
    }
}