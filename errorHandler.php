<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

$logFile = '../logs/error_log.txt';

// Error handler
set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($logFile) {
    error_log("Error: [$errno] $errstr - $errfile:$errline" . PHP_EOL, 3, $logFile);
    return true; 
});

// Exception handler
set_exception_handler(function ($exception) use ($logFile) {
    error_log(
        "Exception: {$exception->getMessage()} in {$exception->getFile()}:{$exception->getLine()}" . PHP_EOL,
        3,
        $logFile
    );
});

// Shutdown handler
register_shutdown_function(function () use ($logFile) {
    $error = error_get_last();
    if ($error) {
        $msg = "Shutdown Error: [{$error['type']}] {$error['message']} in {$error['file']}:{$error['line']}";
        error_log($msg . PHP_EOL, 3, $logFile);
    }
});