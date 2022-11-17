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

    public function list(){
        if(!Router::checkAuth([4])){
            Redirect::redirect('/');
        };
        $data['usuarios'] = true;
        $data['listadoUsuarios'] = $this->model->getUsuarios();
        $this->renderer->render('admin.mustache', $data);
    }

    public function productos(){
        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
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

    public function loadRoles(){
        foreach($this->model->getRoles() as $rol){
            echo "<option value='" . $rol["id"].  "'>" . $rol["descripcion"] . "</option>";
        }
    }

    public function altaUsuario(){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password  = $_POST["password"];
        $latitud  = $_POST["latitud"];
        $longitud  = $_POST["longitud"];
        $role  = $_POST["role"];

        if($this->model->altaUsuario($name, $email, $password, $latitud, $longitud, $role)){
            Redirect::redirect('/admin/usuarios');
        }else{
            $data['error'] = "Error al crear usuario";
            $data['usuarios'] = true;
            $this->renderer->render("admin.mustache", $data);
        }
    }

    public function editorUsuario(){
        $id = $_GET["id"];

        $data['editorUser'] = true;
        $data['id'] = $id;
        $data['usuarios'] = true;

        $usuario = $this->model->getUsuario($id);

        $data['name'] = $usuario[0]['nombre'];
        $data['email'] = $usuario[0]['mail'];
        $data['password'] = $usuario[0]['clave'];
        $data['latitud'] = $usuario[0]['latitud'];
        $data['longitud'] = $usuario[0]['longitud'];
        $data['role'] = $usuario[0]['role'];

        $this->renderer->render('admin.mustache', $data);

    }

    public function editUsuario(){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $latitud  = $_POST["latitud"];
        $longitud  = $_POST["longitud"];
        $role  = $_POST["role"];

        if($_POST["roleEdit"]){ $role  = $_POST["roleEdit"]; }

        $this->model->editUsuario($id, $name, $mail, $latitud, $longitud, $role);

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

    public function getPdfContenidistas() {
        //Sus contenidistas y su información personal
        $data['contenidistas'] = $this->model->getContenidistasReporte();
        $html = $this->renderer->getHtml('reportesPdf/templatePdfContenidistas.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-contenidistas');
    }

    public function getPdfClientes() {
        //Sus clientes y su información personal y producto adquirido
        $data['clientes'] = $this->model->getClientesReporte();
        $html = $this->renderer->getHtml('reportesPdf/templatePdfClientes.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-clientes');
    }

    public function getPdfProductos() {
        //Sus productos con su información básica, cantidad de vendidos/suscritos y ediciones
        $data['productos'] = $this->model->getProductosReporte();
//        $data['ediciones'] = $this->model->getEdicionesReporte();
//        $this->renderer->render('reportesPdf/templatePdfProductos.mustache', $data);
        $html = $this->renderer->getHtml('reportesPdf/templatePdfProductos.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-contenidistas');
    }
}