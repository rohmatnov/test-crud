<?php

namespace Rohmat\CrudTest;

class FlashMessage
{
    private static string $key = '__flash';

    public static function set(string $key, mixed $message): void
    {
        $_SESSION[self::$key][$key] = $message;
    }

    public static function get(string $key): mixed
    {
        return $_SESSION[self::$key][$key] ?? null;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[self::$key][$key]);
    }

    public static function clear(): void
    {
        unset($_SESSION[self::$key]);
    }

    public static function unset(): void
    {
        register_shutdown_function([self::class, 'clear']);
    }
}
