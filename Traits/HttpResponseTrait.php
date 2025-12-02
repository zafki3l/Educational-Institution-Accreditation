<?php

namespace Traits;

trait HttpResponseTrait
{
    /**
     * To send user to new page safely, using project name to avoid wrong paths.
     */
    public function redirect(string $path): void
    {
        header('Location: /' . PROJECT_NAME . $path);
        exit();
    }

    /**
     * To go back to last page, keeping flow smooth without fixed URLs.
     */
    public function back(): void
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}