<?php
namespace App\Core\Router;

class Router {
    private $routes = [];
    private $container;

    public function __construct($container = null) {
        $this->container = $container;
    }

    public function get($path, $handler) {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler) {
        $this->addRoute('POST', $path, $handler);
    }

    public function put($path, $handler) {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete($path, $handler) {
        $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute($method, $path, $handler) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $uri)) {
                return $this->callHandler($route['handler']);
            }
        }
        
        http_response_code(404);
        echo "404 Not Found";
    }

    private function matchPath($routePath, $uri) {
    // Handle dynamic routes like /forum/{id}
        $routePattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $routePath);
        $routePattern = '#^' . $routePattern . '$#';
    
        return preg_match($routePattern, $uri);
    }

    private function callHandler($handler) {
        if (is_string($handler) && strpos($handler, '@') !== false) {
            [$class, $method] = explode('@', $handler);
            $controller = new $class();
            return $controller->$method();
        }

        if (is_callable($handler)) {
            return $handler();
        }

        return $handler;
    }
}
