<?php

namespace Traits;

trait ModelTrait
{
    /**
     * To get property values easily like array, return null if not found to avoid errors.
     */
    public function __get(mixed $name): mixed
    {
        return property_exists($this, $name) ? $this->$name : null;
    }

    /**
     * To set property values safely, only if property exists to prevent wrong changes.
     */
    public function __set($name, $value): void
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    /**
     * To load many values from array into model fast, skip unknown keys for clean data.
     */
    public function fill(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}