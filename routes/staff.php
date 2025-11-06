<?php

use App\Http\Controllers\StaffController;
use App\Http\Middlewares\EnsureAuth;
use App\Http\Middlewares\EnsureStaff;

// Dashboard
$router->middleware([EnsureAuth::class, EnsureStaff::class])->get('/staff/dashboard', [StaffController::class, 'dashboard']);