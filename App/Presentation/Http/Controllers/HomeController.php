<?php

namespace App\Presentation\Http\Controllers;

use Core\Controller;

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