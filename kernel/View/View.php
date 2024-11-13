<?php

namespace App\Kernel\View;

use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\Session;

class View {

    public function __construct(
        private Session $session
    ) {}
    public function page(string $name) : void {
        // в том файле, для которого будет вызываться include_once, можно будет обратиться к переменной view как к глобальной
        // в данном случае при обращении к view мы получим доступ к экземпляру View
       
        
        $viewPath = APP_PATH."/views/pages/$name.php";
        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException("View $name not found");
        }

        extract($this->defaultData());
        
        include_once $viewPath;
    }
    public function component(string $name) : void {
        $componentPath = APP_PATH."/views/components/$name.php";
        if (!file_exists($componentPath )) {
            echo "Comment $name not found";
            return;
        }
        include_once $componentPath;
    }

    private function defaultData() : array {
        return [
            'view' => $this,
            'session' => $this->session
        ];
    }
}