<?php 

namespace App\Validations\Interfaces;

use App\Http\Requests\User\UserRequest;
use App\Repositories\Sql\Interfaces\UserRepositoryInterface;

interface UserValidatorInterface
{
    public function handleUserError(UserRepositoryInterface $userRepository, UserRequest $request, bool $isUpdated): array;
}