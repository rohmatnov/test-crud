<?php

namespace Rohmat\CrudTest;

use mysqli;

class Database
{
    private static ?mysqli $conn;

    public static function connect(array $config): void
    {
        self::$conn = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);

        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
        }
    }

    public static function getConnection(): mysqli
    {
        if (!isset(self::$conn)) {
            throw new \Exception("Database not connected. Please call connect() first.");
        }

        return self::$conn;
    }

    public static function close(): void
    {
        if (isset(self::$conn)) {
            self::$conn->close();
            self::$conn = null;
        }
    }
}
