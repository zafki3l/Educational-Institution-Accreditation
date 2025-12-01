<?php

namespace Traits;

trait HttpRequestTrait
{
    /**
     * To get request type fast, avoid repeat code from server.
     */
    public function getHttpMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * To check if GET request easy, for safe read-only actions.
     */
    public function isGetMethod(): bool
    {
        return $this->getHttpMethod() === 'GET';
    }

    /**
     * To check if POST request easy, for safe data changes.
     */
    public function isPostMethod(): bool
    {
        return $this->getHttpMethod() === 'POST';
    }
}