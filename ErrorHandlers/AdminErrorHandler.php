<?php

namespace ErrorHandlers;

class AdminErrorHandler
{
    public function emptyInput(mixed $name): bool
    {
        return empty($name);
    }
}