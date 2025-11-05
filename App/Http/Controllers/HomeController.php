<?php

namespace App\Http\Controllers;

use Core\Controller as Controller;

/**
 * Class HomeController
 * Handles Homepage logics
 */
class HomeController extends Controller
{
    public function index(): mixed
    {
        return $this->view(
            'homepage',
            'homepage.layouts',
            ['title' => 'Homepage']
        );
    }
}