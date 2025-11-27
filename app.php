<?php

class Router {
    private array $routes = [];

    /**
     * @param string $method
     * @param string $route
     * @param callable(request, response): void $callback
     */
    public function add(string $method, string $route, callable $callback): void {
        $this->routes[$method][$route] = $callback;
    } 
    

    public function run(): void {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = $_SERVER['REQUEST_URI'];
        $callback = $this->routes[$method][$uri];
        match ($callback) {
            null => http_response_code(404),
            default => $callback(),
        };
    }
}


$router = new Router();

$router->add("GET", "/users", function() {
    echo "hi world";
});

$router->run();
