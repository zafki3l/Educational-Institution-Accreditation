<?php

namespace App\Domain\Entities\DataTransferObjects;

abstract class BaseDTO
{
    abstract protected function fields(): array;
    
    public function toArray(): array
    {
        $data = [];

        foreach ($this->fields() as $field) {
            $value = $this->{$field};

            $data[$field] = ($value instanceof \DateTimeInterface) 
                ? $value->format('Y-m-d H:i:s')
                : $value;
        }

        return $data;
    }
}