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

        if($this->model->alta($username, $password)) {
            if ($_SESSION['usuario'] == 1) {
                Redirect::redirect('/lector');
            }

            if ($_SESSION['usuario'] == 2) {
                Redirect::redirect('/contenidista');
            }

            if ($_SESSION['usuario'] == 3) {
                Redirect::redirect('/editor');
            }

            if ($_SESSION['usuario'] == 4) {
                Redirect::redirect('/admin');
            }
        } else {
            $data['error'] = "Revisa los datos de logueo";
            $this->renderer->render("loginForm.mustache", $data);
        }

    }
}