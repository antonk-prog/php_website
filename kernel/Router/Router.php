<?php

namespace App\Kernel\Router;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\ViewInterface;
class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct(
        private ViewInterface $view, 
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
    )
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
            // $controller - путь до класса
            // $action - название функции класса
            [$controller, $action] = $route->getAction();

            // создается movies или home контролеры
            $controller = new $controller();
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller,'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, $action]);

        } else {
            call_user_func($route->getAction());    
            // если передают в Route::get // Route::post анонимную функцию
        }

    }

    private function findRoute(string $uri, string $method) : Route|false {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }
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