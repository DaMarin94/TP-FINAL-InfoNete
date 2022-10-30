<?php

class AdminController{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list(){
        $data['productos'] = true;
        $this->renderer->render('admin.mustache', $data);
    }

    public function productos(){
        $data['productos'] = true;
        $this->renderer->render('admin.mustache', $data);
    }

    public function usuarios(){
        $data['usuarios'] = true;
        $data['listadoUsuarios'] = $this->model->getUsuarios();
        $this->renderer->render('admin.mustache', $data);
    }

    public function formUsuario(){
        $data['formAltaUsuarios'] = true;
        $this->renderer->render('admin.mustache', $data);
    }

    public function altaUsuario(){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password  = $_POST["password"];
        $ubicacion  = $_POST["ubicacion"];
        $role  = $_POST["role"];

        if($this->model->altaUsuario($name, $email, $password, $ubicacion, $role)){
            Redirect::redirect('/admin/usuarios');
        }else{
            $data['error'] = "Error al crear usuario";
            $data['usuarios'] = true;
            Redirect::redirect('/admin/usuarios');
            $this->renderer->render("admin.mustache", $data);
        }
    }

    public function reportes(){
        $data['reportes'] = true;
        $this->renderer->render('admin.mustache', $data);
    }
}