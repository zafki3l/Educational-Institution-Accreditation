<?php

namespace App\Services\Interfaces\User;

use App\Http\Requests\User\UserRequest;

interface HandleUserErrorServiceInterface
{
    public function handleError(UserRequest $request, $isUpdated = false): ?array;
}