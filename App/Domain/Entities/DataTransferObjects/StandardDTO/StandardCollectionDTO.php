<?php

namespace App\Domain\Entities\DataTransferObjects\StandardDTO;

class StandardCollectionDTO
{
    protected array $items = [];

    public function append(BaseStandardDTO $dto): void
    {
        $this->items[] = $dto;
    }

    public function toArray(): array
    {
        return array_map(
            fn(BaseStandardDTO $dto) => $dto->toArray(),
            $this->items
        );
    }
}
