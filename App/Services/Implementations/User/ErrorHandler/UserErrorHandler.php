<?php

namespace App\Services\Implementations\User\ErrorHandler;

use App\Http\Requests\User\UserRequest;
use App\Repositories\Sql\Implementations\User\MySqlUserRepository;
use App\Validations\Implement\UserValidator;

/**
 * This service delegates validation logic to validators
 * and returns normalized error data for upper layers. 
 */
class UserErrorHandler
{
    public function __construct(private UserValidator $userValidator,
                                private MySqlUserRepository $repository) {}

    public function handleError(UserRequest $request, $isUpdated = false): ?array
    {
        $errors = $this->userValidator->handleUserError($this->repository, $request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }
}