<?php 

namespace App\Validations\Interfaces;

use App\Repositories\Sql\Interfaces\UserRepositoryInterface;

interface UserValidatorInterface
{
    public function handleUserError(UserRepositoryInterface $userRepository, array $request, bool $isUpdated): array;
}