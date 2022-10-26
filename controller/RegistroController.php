<?php

class RegistroController{
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
        echo $this->renderer->render("registroForm.mustache");
    }

    public function procesarAlta(){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password  = $_POST["password"];
        $residencia  = $_POST["residencia"];

        // $this->model->alta($name, $email, $password, $residencia);

        if($this->model->alta($name, $email, $password, $residencia)){
            Redirect::redirect('/');
        }else{
            $data['error'] = "Error al registrarse";
            $this->renderer->render("registroForm.mustache", $data);
        }


    }
}