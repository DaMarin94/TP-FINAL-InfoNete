<?php

class AdminController{
    private $renderer;
    private $model;
    private $pdfGenerator;

    public function __construct($render, $model, $pdfGenerator){
        $this->renderer = $render;
        $this->model = $model;
        $this->pdfGenerator = $pdfGenerator;
    }

    public function validarRol(){
        if(!Router::checkAuth([4])){
            Redirect::redirect('/');
        };
    }

    public function list(){
        $this->validarRol();

        $data['usuarios'] = true;
        $data['listadoUsuarios'] = $this->model->getUsuarios();
        $this->renderer->render('admin.mustache', $data);
    }

    public function productos(){
        $this->validarRol();

        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('admin.mustache', $data);
    }

    public function usuarios(){
        $this->validarRol();

        $data['usuarios'] = true;
        $data['listadoUsuarios'] = $this->model->getUsuarios();
        $this->renderer->render('admin.mustache', $data);
    }

    public function formUsuario(){
        $this->validarRol();

        $data['formAltaUsuarios'] = true;
        $this->renderer->render('admin.mustache', $data);
    }

    public function loadRoles(){
        $this->validarRol();

        foreach($this->model->getRoles() as $rol){
            echo "<option value='" . $rol["id"].  "'>" . $rol["descripcion"] . "</option>";
        }
    }

    public function altaUsuario(){
        $this->validarRol();

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

    public function editorUsuario(){
        $this->validarRol();

        $id = $_GET["id"];

        $data['editorUser'] = true;
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
        $this->validarRol();

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
        $this->validarRol();

        $id = $_GET["id"];

        $this->model->deleteUsuario($id);

        Redirect::redirect('/admin/usuarios');
    }

    public function reportes(){
        $this->validarRol();

        $data['reportes'] = true;
        $this->renderer->render('admin.mustache', $data);
    }

    public function getPdfContenidistas() {
        $this->validarRol();

        //Sus contenidistas y su información personal
        $data['contenidistas'] = $this->model->getContenidistas();
        $html = $this->renderer->getHtml('reportesPdf/templatePdfContenidistas.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-contenidistas');
    }

    public function getPdfClientes() {
        $this->validarRol();

        //Sus clientes y su información personal y producto adquirido
        $data['contenidistas'] = $this->model->getContenidistas();
        $html = $this->renderer->getHtml('reportesPdf/templatePdfContenidistas.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-contenidistas');
    }

    public function getPdfProductos() {
        $this->validarRol();

        //Sus productos con su información básica, cantidad de vendidos/suscritos y ediciones
        $data['contenidistas'] = $this->model->getContenidistas();
        $html = $this->renderer->getHtml('reportesPdf/templatePdfContenidistas.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-contenidistas');
    }
}