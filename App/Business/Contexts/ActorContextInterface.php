<?php

namespace App\Business\Contexts;

interface ActorContextInterface
{
    public function id(): int;

    public function firstName(): string;

    public function lastName(): string;

    public function fullName(): string;

    public function roleId(): int;
}