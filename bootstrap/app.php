<?php

require_once __DIR__ . '/../vendor/autoload.php';
// require_once __DIR__ . '/../errorHandler.php';
require_once __DIR__ . '/../Configs/config.php';
require_once __DIR__ . '/../helper.php';

use Dotenv\Dotenv;
use App\Http\Middlewares\CSRF_Authenticator;
use App\Services\Implementations\Auth\SessionService;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

SessionService::generate();
CSRF_Authenticator::generate();

require_once __DIR__ . '/DI_Container/container.php';
