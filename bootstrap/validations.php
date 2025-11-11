<?php

use App\Validations\Implement\AuthValidator;
use App\Validations\Implement\UserValidator;
use App\Validations\Interfaces\AuthValidatorInterface;
use App\Validations\Interfaces\UserValidatorInterface;

$container->bind(UserValidatorInterface::class, function () {
    return new UserValidator();
}); 

$container->bind(AuthValidatorInterface::class, function () {
    return new AuthValidator();
}); 