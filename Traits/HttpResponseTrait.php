<?php

namespace Traits;

trait HttpResponseTrait
{
    public function redirect(string $path): void
    {
        header('Location: /' . PROJECT_NAME . $path);
        exit();
    }

    public function back(): void
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
