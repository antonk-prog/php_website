<?php

namespace App\Kernel\Container;
use App\Kernel\Http\Redirect;
use App\Kernel\Router\Router;
use App\Kernel\Http\Request;
use App\Kernel\Session\Session;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;
class Container {
    public readonly Request $request;
    public readonly Router $router;

    public readonly View $view;
    public readonly Validator $validator;

    public readonly Redirect $redirect;

    public readonly Session $session;
    public function __construct() {
        $this->registerServices();
    }

    private function registerServices() {
        $this->request = Request::createFromGlobals(); 
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->view = new View($this->session);
        $this->router = new Router($this->view, $this->request, $this->redirect, $this->session);
        $this->validator = new Validator();
        $this->request->setValidator($this->validator);
    }
}