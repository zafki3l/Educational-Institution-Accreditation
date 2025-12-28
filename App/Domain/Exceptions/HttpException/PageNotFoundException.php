<?php

namespace App\Domain\Exceptions\HttpException;

use App\Domain\Exceptions\BusinessException;

class PageNotFoundException extends BusinessException
{
    public function __construct()
    {
        parent::__construct(
            "The request url/page is not found!",
            'PAGE_NOT_FOUND',
            404
        );
    }
}