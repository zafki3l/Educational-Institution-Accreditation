<?php 

namespace App\Domain\Entities\DataTransferObjects\EvidenceDTO;

use Core\BaseDTO;

class BaseEvidenceDTO extends BaseDTO
{
    public function __construct(protected string $id,
                                protected string $name) {}
    
    public function fields(): array
    {
        return [
            'id',
            'name'
        ];
    }
}