<?php

namespace Traits;

trait HttpRequestTrait
{
    public function getHttpMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isGetMethod(): bool
    {
        return $this->getHttpMethod() === 'GET';
    }

    public function isPostMethod(): bool
    {
        return $this->getHttpMethod() === 'POST';
    }
}