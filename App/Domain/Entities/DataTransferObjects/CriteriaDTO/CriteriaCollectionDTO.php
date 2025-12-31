<?php

namespace App\Domain\Entities\DataTransferObjects\CriteriaDTO;

class CriteriaCollectionDTO
{
    protected array $items = [];

    public function append(BaseCriteriaDTO $dto): void
    {
        $this->items[] = $dto;
    }

    public function toArray(): array
    {
        return array_map(
            fn (BaseCriteriaDTO $dto) => $dto->toArray(), 
            $this->items
        );
    }
}