<?php

namespace App\Presentation\Http\Controllers;

use Core\Controller;

/**
 * Class StaffController
 * Handles Book Management, Order and other Staff logics
 */
class StaffController extends Controller
{
    public function __construct() {}
    
    /**
     * Shows staff dashboard view
     * @return mixed
     */
    public function index(): mixed
    {
        return $this->view(
            'staff/dashboard', 
            'staff.layouts',
            ['title' => 'Staff Dashboard']
        );
    }
}