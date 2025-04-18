<?php

use Rohmat\CrudTest\FlashMessage;
use Rohmat\CrudTest\ViewRenderer;

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        $base = $_SERVER['SCRIPT_NAME'] ?? '';
        $base = rtrim(str_replace('/index.php', '', $base), '/');

        return $base . '/' . ltrim($path, '/');
    }
}

if (!function_exists('url')) {
    function url(string $path): string
    {
        $base = $_SERVER['SCRIPT_NAME'] ?? '';
        $base = rtrim(str_replace('/index.php', '', $base), '/');

        return $base . '/' . ltrim($path, '/');
    }
}

if (!function_exists('redirect')) {
    function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit;
    }
}

if (!function_exists('old')) {
    function old(string $name, string $default = ''): ?string
    {
        return esc(FlashMessage::get('old')[$name] ?? $default);
    }
}

if (!function_exists('abort')) {
    function abort(int $code = 404, ?string $message = null): void
    {
        http_response_code($code);

        $view = new ViewRenderer();
        echo $view->render('error-view', ['code' => $code, 'message' => $message ?? 'Kami tidak dapat memproses permintaan anda saat ini.']);
        exit;
    }
}

if (!function_exists('abort_if')) {
    function abort_if(bool $condition, int $code = 404, ?string $message = null): void
    {
        if ($condition) {
            abort($code, $message);
        }
    }
}

if (!function_exists('esc')) {
    function esc(string $value): string
    {
        return htmlspecialchars($value);
    }
}
