<?php

namespace Core;

class Validator
{
    /**
     * Check is input empty
     * @param mixed $name
     * @return bool
     */
    public function emptyInput($name): bool
    {
        return empty($name);
    }
}