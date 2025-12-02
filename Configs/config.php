<?php

// Path configuration
$rootFolder = basename(dirname(__DIR__));
define('PROJECT_NAME', $rootFolder);
define('BASE_PATH', dirname(__DIR__));
define('VIEW_PATH', BASE_PATH . '/app/Views/');
define('ROOT_PATH', __DIR__);