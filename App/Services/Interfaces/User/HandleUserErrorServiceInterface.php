<?php

namespace App\Services\Interfaces\User;

use App\Http\Requests\User\UserRequest;

/**
 * This service delegates validation logic to validators
 * and returns normalized error data for upper layers. 
 */
interface HandleUserErrorServiceInterface
{
    public function handleError(UserRequest $request, $isUpdated = false): ?array;
}