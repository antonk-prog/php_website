<?php
namespace App\Kernel\Controller;
use App\Kernel\Http\Request;
use App\Kernel\Session\Session;
use App\Kernel\View\View;
use App\Kernel\Http\Redirect;
abstract class Controller {
    private View $view; 
    private Request $request;

    private Redirect $redirect;

    private Session $session;

    public function request(): Request {
        return $this->request;
    }
    public function setRequest(Request $req): void {
        $this->request = $req;
    }

    public function view(string $name) : void {
        $this->view->page($name);
    }
    public function setView(View $view) : void {
        $this->view = $view;    
    }

    public function setRedirect(Redirect $redirect) : void {
        $this->redirect = $redirect;
    }

    public function redirect(string $url) : void {
        $this->redirect->to($url); 
    }

    public function session() : Session {
        return $this->session;
    }
    public function setSession(Session $session) : void {
        $this->session = $session;
    }
}