<?php

namespace App\Domain\Entities\DataTransferObjects;

class CommandResult
{
    public function __construct(public readonly mixed $id,
                                public readonly ?array $data,
                                public readonly bool $isSuccess) {}
}