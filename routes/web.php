<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middlewares\EnsureAuth;

// Homepage
$router->middleware([EnsureAuth::class])
    ->get('/', [HomeController::class, 'index']);

// Auth Routes
$router->get('/login', [AuthController::class, 'showLogin']);

$router->post('/login', [AuthController::class, 'login']);

$router->middleware([EnsureAuth::class])
    ->post('/logout', [AuthController::class, 'logout']);
