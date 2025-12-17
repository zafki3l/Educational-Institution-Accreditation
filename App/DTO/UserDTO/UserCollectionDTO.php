<?php

namespace App\DTO\UserDTO;

class UserCollectionDTO
{
    protected array $items = [];

    public function append(mixed $dto): void
    {
        $this->items[] = $dto;
    }

    public function toArray(): array
    {
        return array_map(
            fn (mixed $dto) => $dto->toArray(), 
            $this->items
        );
    }
}