<?php 

namespace App\Validations\Interfaces;

use App\Http\Requests\User\UserRequest;
use App\Repositories\Sql\Implementations\User\MySqlUserRepository;

interface UserValidatorInterface
{
    public function handleUserError(MySqlUserRepository $userRepository, UserRequest $request, bool $isUpdated): array;
}