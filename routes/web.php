<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middlewares\CSRF_Authenticator;
use App\Http\Middlewares\EnsureAuth;

// Homepage
$router->middleware([EnsureAuth::class])->get('/', [HomeController::class, 'index']);

// Auth Routes
$router->get('/login', [AuthController::class, 'showLogin']);
$router->middleware([CSRF_Authenticator::class])->post('/login', [AuthController::class, 'login']);
$router->middleware([EnsureAuth::class, CSRF_Authenticator::class])->post('/logout', [AuthController::class, 'logout']);
