<?php

namespace App;

use App\Router\Router;

class App
{
    public function run(): void
    {
        $router = new Router(); 
        $method = $_SERVER["REQUEST_METHOD"];

        $uri = $_SERVER['REQUEST_URI'];

        $router->dispatch($uri, $method);
    } 
}