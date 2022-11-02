<?php

class AdminController{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list(){
        if(!Router::checkAuth([4])){
            Redirect::redirect('/');
        };
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
            $this->renderer->render("admin.mustache", $data);
        }
    }

    public function editor(){
        $id = $_GET["id"];

        $data['editor'] = true;
        $data['id'] = $id;
        $data['usuarios'] = true;

        $usuario = $this->model->getUsuario($id);

        $data['name'] = $usuario[0]['nombre'];
        $data['email'] = $usuario[0]['mail'];
        $data['password'] = $usuario[0]['clave'];
        $data['ubicacion'] = $usuario[0]['ubicacion'];
        $data['role'] = $usuario[0]['role'];

        $this->renderer->render('admin.mustache', $data);

    }

    public function editUsuario(){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $mail = $_POST["mail"];
//        $password  = $_POST["password"];
        $ubicacion  = $_POST["ubicacion"];
        $role  = $_POST["role"];

        if($_POST["roleEdit"]){ $role  = $_POST["roleEdit"]; }

        $this->model->editUsuario($id, $name, $mail, $ubicacion, $role);

        Redirect::redirect('/admin/usuarios');
    }

    public function deleteUsuario(){
        $id = $_GET["id"];

        $this->model->deleteUsuario($id);

        Redirect::redirect('/admin/usuarios');
    }

    public function reportes(){
        $data['reportes'] = true;
        $this->renderer->render('admin.mustache', $data);
    }
}