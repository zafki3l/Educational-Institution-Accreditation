<?php

namespace ErrorHandlers;

class AdminErrorHandler
{
    public function emptyInput($name): bool
    {
        return empty($name);
    }
}