<?php

class LoginController{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }
    public function list(){
        echo $this->renderer->render("loginForm.mustache");
    }

    public function procesarAlta(){
        $username = $_POST["username"];
        $password  = $_POST["password"];

        if($this->model->alta($username, $password)) {
            switch($_SESSION['usuario']['role']){
                case 1:
                    $_SESSION['usuario']['roleName'] = 'admin';
                    Redirect::redirect('/admin');
                    break;
                case 2:
                    $_SESSION['usuario']['roleName'] = 'editor';
                    Redirect::redirect('/editor');
                    break;
                case 3:
                    $_SESSION['usuario']['roleName'] = 'contenidista';
                    Redirect::redirect('/contenidista');
                    break;
                case 4:
                    $_SESSION['usuario']['roleName'] = 'lector';
                    Redirect::redirect('/lector');
                    break;
                default:
                    Redirect::redirect('/');
                    break;
            }
        } else {
            $data['error'] = "Revisa los datos de logueo";
            $this->renderer->render("loginForm.mustache", $data);
        }

    }
}