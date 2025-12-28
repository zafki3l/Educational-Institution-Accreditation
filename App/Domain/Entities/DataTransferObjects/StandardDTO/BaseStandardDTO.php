<?php 

namespace App\Domain\Entities\DataTransferObjects\StandardDTO;

use Core\BaseDTO;

class BaseStandardDTO extends BaseDTO
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