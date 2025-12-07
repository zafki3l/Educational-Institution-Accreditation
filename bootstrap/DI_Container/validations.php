<?php

use App\Validations\Implement\AuthValidator;
use App\Validations\Implement\FileUploadValidator;
use App\Validations\Implement\UserValidator;
use App\Validations\Interfaces\AuthValidatorInterface;
use App\Validations\Interfaces\FileUploadValidatorInterface;
use App\Validations\Interfaces\UserValidatorInterface;

use function DI\autowire;

return [
    UserValidatorInterface::class => autowire(UserValidator::class),
    AuthValidatorInterface::class => autowire(AuthValidator::class),
    FileUploadValidatorInterface::class => autowire(FileUploadValidator::class)
];