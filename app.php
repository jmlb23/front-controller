<?php declare(strict_types = 1);

class Router {
    private array $routes = [];

    /**
     * @param string $method
     * @param string $route
     * @param callable(array): void $callback
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
            default => $callback($_REQUEST),
        };
    }
}


$router = new Router();
$router->add("POST", "/users", function (array $req){
    echo "this should be shown only on post calls";
});
$router->add("GET", "/users", function(array $req) {
    echo "hi world";
});

$router->run();
