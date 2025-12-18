<?php

namespace App\Services\Implementations\User;

use App\Http\Requests\User\UserRequest;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\User\HandleUserErrorServiceInterface;
use App\Validations\Interfaces\UserValidatorInterface;

class HandleUserErrorService implements HandleUserErrorServiceInterface
{
    public function __construct(private UserValidatorInterface $userValidator,
                                private UserRepositoryInterface $userRepository) {}

    public function handleError(UserRequest $request, $isUpdated = false): ?array
    {
        $errors = $this->userValidator->handleUserError($this->userRepository, $request, $isUpdated);

        return !empty($errors) ? $errors : null;
    }
}