<?php

use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\StaffController;
use App\Http\Middlewares\EnsureAuth;
use App\Http\Middlewares\EnsureStaff;

// Dashboard
$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/dashboard', [StaffController::class, 'index']);

// Evidences
$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/evidences', [EvidenceController::class, 'index']);

$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/evidences/create', [EvidenceController::class, 'create']);

$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->post('/staff/evidences', [EvidenceController::class, 'store']);