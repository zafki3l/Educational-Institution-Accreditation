<?php

namespace App\Exceptions\HttpException;

use App\Exceptions\BusinessException;

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