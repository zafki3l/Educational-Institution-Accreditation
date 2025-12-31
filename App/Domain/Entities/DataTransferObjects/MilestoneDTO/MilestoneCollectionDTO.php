<?php

namespace App\Domain\Entities\DataTransferObjects\MilestoneDTO;

class MilestoneCollectionDTO
{
    protected array $items = [];

    public function append(BaseMilestoneDTO $dto): void
    {
        $this->items[] = $dto;
    }

    public function toArray(): array
    {
        return array_map(
            fn (BaseMilestoneDTO $dto) => $dto->toArray(), 
            $this->items
        );
    }
}