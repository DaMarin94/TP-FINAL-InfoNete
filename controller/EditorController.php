<?php

class EditorController
{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list(){
       // $data['contenidos'] = true;
       // $data['listaContenidos'] = $this->model->getContenidos();
        echo $this->renderer->render("editor.mustache");
    }

    public function formContenido(){
        $data['formAltaContenido'] = true;
        $data['contenidos'] = $this->model->getContenidos();
        echo $this->renderer->render("editor.mustache", $data);
    }

    public function contenidos(){
        $data['contenidos'] = true;
        $data['listaContenidos'] = $this->model->getContenidos();
        $this->renderer->render('editor.mustache', $data);
    }

    public function reportes(){
        $data['reportes'] = true;
        echo $this->renderer->render('editor.mustache', $data);
    }

    /*

    public function formEdicion(){
        $data['formAltaUsuarios'] = true;
        $this->renderer->render('admin.mustache', $data);
    }

    public function procesarAlta(){
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
            $this->renderer->render("admin.mustache", $data);
        }
    }*/

}