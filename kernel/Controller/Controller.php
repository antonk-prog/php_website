<?php
namespace App\Kernel\Controller;
use App\Kernel\Http\Request;
use App\Kernel\View\View;

abstract class Controller {
    private View $view; 
    private Request $request;

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
}