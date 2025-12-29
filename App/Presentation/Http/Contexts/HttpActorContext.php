<?php

namespace App\Presentation\Http\Contexts;

use App\Business\Contexts\ActorContextInterface;

class HttpActorContext implements ActorContextInterface
{
    public function __construct(private array $actor) {}

    public function id(): int
    {
        return $this->actor['user_id'];
    }

    public function firstName(): string
    {
        return $this->actor['first_name'];
    }

    public function lastName(): string
    {
        return $this->actor['last_name'];
    }

    public function fullName(): string
    {
        return "{$this->firstName()} {$this->lastName()}";
    }

    public function roleId(): int
    {
        return $this->actor['role_id'];
    }
}