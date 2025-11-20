<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

$logFile = '../logs/error.log';

// Error handler
set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($logFile) {
    error_log("Error: [$errno] $errstr - $errfile:$errline" . PHP_EOL, 3, $logFile);
    return true; 
});

// Exception handler
set_exception_handler(function ($exception) use ($logFile) {
    if ($exception instanceof \App\Exceptions\BusinessException) {
        error_log(
            "[BusinessException] {$exception->getErrorCode()} - {$exception->getMessage()} | meta: " . json_encode($exception->getMeta()) . PHP_EOL,
            3,
            $logFile
        );

        http_response_code($exception->getHttpStatus() ?? 400);
        echo json_encode([
            'error' => $exception->getMessage(),
            'code' => $exception->getErrorCode(),
            'meta' => $exception->getMeta()
        ]);
    } else {
        error_log("[Unhandled Exception] {$exception->getMessage()}" . PHP_EOL, 3, $logFile);
        http_response_code(500);
        echo json_encode(['error' => 'Internal server error']);
    }
});

// Shutdown handler
register_shutdown_function(function () use ($logFile) {
    $error = error_get_last();
    if ($error) {
        $msg = "Shutdown Error: [{$error['type']}] {$error['message']} in {$error['file']}:{$error['line']}";
        error_log($msg . PHP_EOL, 3, $logFile);
    }
});