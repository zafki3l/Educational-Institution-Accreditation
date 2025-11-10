<?php

namespace App\Http\Controllers;

use Core\Controller;
use Traits\HttpResponseTrait;

/**
 * Class Admin Controller
 */
class AdminController extends Controller
{
    use HttpResponseTrait;

    public function __construct() {}

    public function dashboard(): mixed
    {
        return $this->view(
            'admin/dashboard',
            'admin.layouts',
            [
                'title' => 'Admin Dashboard'
            ]
        );
    }
}
