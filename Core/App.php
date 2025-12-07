<?php

namespace Core;

use DI\Container;

/**
 * Class App
 * 
 * This class serves as the main container for the application, managing dependency injection
 * and service resolution throughout the application lifecycle. It provides a centralized
 * way to handle service container functionality and dependency management.
 * 
 */
class App
{
    protected static Container $container;

    /**
     * Set the application's container instance
     */
    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    /**
     * Resolve a class instance through the container
     */
    public static function resolve(string $class): object
    {
        return static::container()->get($class);
    }

    /**
     * Get the current container instance
     */
    private static function container(): Container
    {
        return static::$container;
    }
}
