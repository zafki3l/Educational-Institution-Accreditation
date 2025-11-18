<?php

use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StandardController;
use App\Http\Middlewares\EnsureAuth;
use App\Http\Middlewares\EnsureStaff;

// Dashboard
$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/dashboard', [StaffController::class, 'index']);

// Standards
$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/standards', [StandardController::class, 'index']);

// Criterias
$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/criterias', [CriteriaController::class, 'index']);

// Milestones
$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/milestones', [MilestoneController::class, 'index']);

// Evidences
$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/evidences', [EvidenceController::class, 'index']);

$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/evidences/create', [EvidenceController::class, 'create']);

$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->post('/staff/evidences', [EvidenceController::class, 'store']);


$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/evidences/{id}/edit', [EvidenceController::class, 'edit']);

$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->put('/staff/evidences/{id}', [EvidenceController::class, 'update']);

$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->delete('/staff/evidences/{id}', [EvidenceController::class, 'destroy']);

$router->middleware([EnsureAuth::class, EnsureStaff::class])
    ->get('/staff/evidences/{id}/criterias', [EvidenceController::class, 'criterias']);

