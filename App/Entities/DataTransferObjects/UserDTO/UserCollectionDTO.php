<?php

namespace App\Entities\DataTransferObjects\UserDTO;

class UserCollectionDTO
{
    protected array $items = [];

    public function append(BaseUserDTO $dto): void
    {
        $this->items[] = $dto;
    }

    public function toArray(): array
    {
        return array_map(
            fn (BaseUserDTO $dto) => $dto->toArray(), 
            $this->items
        );
    }
}