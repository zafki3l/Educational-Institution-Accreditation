<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Middlewares\EnsureAdmin;
use App\Http\Middlewares\EnsureAuth;

// Dashboard
$router->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/admin/dashboard', [AdminController::class, 'dashboard']);

// Users
$router->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/admin/users', [UserController::class, 'index']);

$router->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/admin/users/create', [UserController::class, 'create']);

$router->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->post('/admin/users', [UserController::class, 'store']);

$router->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/admin/users/{id}/edit', [UserController::class, 'edit']);

$router->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->put('/admin/users/{id}', [UserController::class, 'update']);
    
$router->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->delete('/admin/users/{id}', [UserController::class, 'destroy']);

// Departments
$router->middleware([EnsureAuth::class, EnsureAdmin::class])
    ->get('/admin/departments', [DepartmentController::class, 'index']);