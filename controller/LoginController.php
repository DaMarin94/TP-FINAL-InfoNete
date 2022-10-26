<?php

class LoginController{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }
    public function list(){
        echo "nada";
    }

    public function alta(){
        echo $this->renderer->render("loginForm.mustache");
    }

    public function procesarAlta(){
        $username = $_POST["username"];
        $password  = $_POST["password"];

        $this->model->alta($username, $password);

        if($_SESSION['usuario'] == 'lector'){
            Redirect::redirect('/noticias');
        }

        if($_SESSION['usuario'] == 'administrador'){
            Redirect::redirect('/');
        }

        if($_SESSION['usuario'] == 'contenidista'){
            Redirect::redirect('/');
        }

        if($_SESSION['usuario'] == 'editor'){
            Redirect::redirect('/');
        }
    }
}