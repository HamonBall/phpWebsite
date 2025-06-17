<?php
namespace App\Core;

class Router {
    private $routes = [];
    public function add($route, $action) {
        $this->routes[$route] = $action;
    }
    public function dispatch($uri) {
        foreach ($this->routes as $route => $action) {
            // Convert route pattern to regex for dynamic parameters
            $pattern = preg_replace('#\{[a-zA-Z_][a-zA-Z0-9_]*\}#', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove full match
                list($controller, $method) = explode('@', $action);
                $controller = 'App\\Controllers\\' . $controller;
                (new $controller)->$method(...$matches);
                return;
            }
        }
        http_response_code(404);
        echo '404 Not Found';
    }
}
