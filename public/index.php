<?php

declare(strict_types=1);

require_once '../Configs/config.php';
require_once '../vendor/autoload.php';
require_once '../errorHandler.php';

use App\Http\Middlewares\CSRF_Authenticator;
use App\Services\Implementations\SessionService;
use Core\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

SessionService::generate();

require_once '../helper.php';
require_once '../bootstrap/DI_Container/app.php';

CSRF_Authenticator::generate();

$router = new Router();

$rootPath = '/' . $rootFolder;
$path = str_replace($rootPath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

foreach (glob(BASE_PATH . '/routes/*.php') as $filename) {
    require_once $filename;
}

$router->dispatch($path, $_SERVER['REQUEST_METHOD']);