<?php
namespace App\Controllers;
use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\Validator\Validator;

class MovieController extends Controller{
    public function index() : void {
        $this->view('movies');

    } 

    public function add() : void {
        $this->view('admin/movies/add');
    }

    public function store() : void {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50']
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors){
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/movies/add');
            // dd('Validation failed', $this->reques    t()->errors());
        }

        dd('Validation passed');
    }
}
