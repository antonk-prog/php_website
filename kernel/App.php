<?php

namespace App\Kernel;

use App\Kernel\Router\Router;
use App\Kernel\Http\Request;
class App
{
    public function run(): void
    {
        $router = new Router(); 
        $requst = Request::createFromGlobals();
        // dd($requst);


        $router->dispatch($requst->uri(), $requst->method());
    } 
}