<?php

namespace App\DTO\EvidenceDTO;

class EvidenceCollectionDTO
{
    protected array $items = [];

    public function append(BaseEvidenceDTO $dto): void
    {
        $this->items[] = $dto;
    }

    public function toArray(): array
    {
        return array_map(
            fn (BaseEvidenceDTO $dto) => $dto->toArray(), 
            $this->items
        );
    }
}