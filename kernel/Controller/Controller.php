<?php
namespace App\Kernel\Controller;

use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\ViewInterface;
use App\Kernel\Http\RedirectInterface;
abstract class Controller {
    private ViewInterface $view; 
    private RequestInterface $request;

    private RedirectInterface $redirect;

    private SessionInterface $session;

    public function request(): RequestInterface {
        return $this->request;
    }
    public function setRequest(RequestInterface $req): void {
        $this->request = $req;
    }

    public function view(string $name) : void {
        $this->view->page($name);
    }
    public function setView(ViewInterface $view) : void {
        $this->view = $view;    
    }

    public function setRedirect(RedirectInterface $redirect) : void {
        $this->redirect = $redirect;
    }

    public function redirect(string $url) : void {
        $this->redirect->to($url); 
    }

    public function session() : SessionInterface {
        return $this->session;
    }
    public function setSession(SessionInterface $session) : void {
        $this->session = $session;
    }
}