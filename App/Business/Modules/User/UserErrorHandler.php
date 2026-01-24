<?php

namespace App\Business\Modules\User;

use App\Presentation\Http\Requests\User\UserRequest;
use App\Business\Ports\UserRepositoryInterface;

/**
 * This service delegates validation logic to validators
 * and returns normalized error data for upper layers. 
 */
class UserErrorHandler
{
    public function __construct(
        private UserValidator $userValidator,
        private UserRepositoryInterface $repository
    ) {}

    /**
     * To provide a consistent error format for the presentation layer.
     * By using the $isUpdated flag, we allow this single method to handle 
     * both "Create" and "Update" logic, which slightly differ (e.g., an 
     * update doesn't trigger a 'duplicate email' error for the user's own email).
     * 
     * @param UserRequest $request
     * @param mixed $isUpdated
     * @return array|null
     */
    public function handleError(UserRequest $request, $isUpdated = false): ?array
    {
        $errors = $this->userValidator->handleUserError($this->repository, $request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }
}
