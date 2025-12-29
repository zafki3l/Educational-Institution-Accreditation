<?php

namespace App\Business\ErrorHandler;

use App\Presentation\Http\Requests\User\UserRequest;
use App\Business\Validations\Implementions\UserValidator;
use App\Persistent\Repositories\Sql\Interfaces\UserRepositoryInterface;

/**
 * This service delegates validation logic to validators
 * and returns normalized error data for upper layers. 
 */
class UserErrorHandler
{
    public function __construct(private UserValidator $userValidator,
                                private UserRepositoryInterface $repository) {}

    public function handleError(UserRequest $request, $isUpdated = false): ?array
    {
        $errors = $this->userValidator->handleUserError($this->repository, $request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }
}