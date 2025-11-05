<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middlewares\CSRF_Authenticator;
use App\Http\Middlewares\EnsureAdmin;
use App\Http\Middlewares\EnsureAuth;

// Dashboard
$router->middleware([EnsureAuth::class, EnsureAdmin::class])->get('/admin/dashboard', [AdminController::class, 'index']);
$router->middleware([EnsureAuth::class, EnsureAdmin::class])->get('/admin/users/create', [UserController::class, 'create']);
$router->middleware([EnsureAuth::class, EnsureAdmin::class, CSRF_Authenticator::class])->post('/admin/users', [UserController::class, 'store']);
$router->middleware([EnsureAuth::class, EnsureAdmin::class])->get('/admin/users/{id}/edit', [UserController::class, 'edit']);
$router->middleware([EnsureAuth::class, EnsureAdmin::class, CSRF_Authenticator::class])->put('/admin/users/{id}', [UserController::class, 'update']);
$router->middleware([EnsureAuth::class, EnsureAdmin::class, CSRF_Authenticator::class])->delete('/admin/users/{id}', [UserController::class, 'destroy']);