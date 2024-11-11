<?php

namespace App\Kernel\Router;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct()
    {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (! $route) {
            $this->notFound();
            exit;   
        }
        if (is_array($route->getAction())){
            [$controller, $action] = $route->getAction();

            
            $controller = new $controller();
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());    
            // если передают в Route::get // Route::post анонимную функцию
        }
        // $route->getAction()();
        // dd($route[$uri]());    
    }

    private function findRoute(string $uri, string $method) : Route|false {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }

        // dd($this->routes[$method][$uri]);
        // dd(get_class($this->routes[$method][$uri]));
        return $this->routes[$method][$uri];
    }

    private function initRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
        
    }

    private function notFound() : void{
        echo "404 | Not Found";
    }

    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require APP_PATH.'/config/routes.php';
    }
}