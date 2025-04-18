<?php

namespace Rohmat\CrudTest;

use Rohmat\CrudTest\Attributes\Route;

final class Router
{
    private array $routes = [];

    public function useController(string $prefix, string $controller)
    {
        $refClass = new \ReflectionClass($controller);

        $instance = new $controller();

        foreach ($refClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getAttributes(Route::class) as $attribute) {
                $route = $attribute->newInstance();

                $path = $this->normalizePath($prefix . $route->path);

                $this->routes[$route->method][$path] = [$instance, $method->getName()];
            }
        }
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = base_path();

        if (strlen($basePath) > 0 && str_starts_with($uriPath, $basePath)) {
            $path = substr($uriPath, strlen($basePath));
        } else {
            $path = $uriPath;
        }

        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            $regex = preg_replace('#\:(\w+)#', '([^/]+)', $route);

            if (preg_match('#^' . $regex . '$#', $path, $matches)) {
                array_shift($matches);

                [$controller, $method] = $handler;

                return call_user_func_array([$controller, $method], $matches);
            }
        }

        return abort(404);
    }

    private function normalizePath(string $path): string
    {
        $path = '/' . trim($path, '/');

        return match ($path) {
            '/' => '/',
            default => rtrim($path, '/'),
        };
    }
}
