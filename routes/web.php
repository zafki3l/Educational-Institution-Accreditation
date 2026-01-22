<?php

use App\Presentation\Http\Controllers\AuthController;
use App\Presentation\Http\Controllers\HomeController;
use App\Presentation\Http\Middlewares\EnsureAuth;

// Homepage
$router->get('/', [HomeController::class, 'index']);

$router->middleware([EnsureAuth::class])
    ->get('/evidences', [HomeController::class, 'evidenceList']);

// Auth Routes
$router->get('/login', [AuthController::class, 'showLogin']);

$router->post('/login', [AuthController::class, 'login']);

$router->middleware([EnsureAuth::class])
    ->post('/logout', [AuthController::class, 'logout']);

$router->middleware([EnsureAuth::class])
    ->get('/evidences/{link}', [HomeController::class, 'showEvidence']);