<?php

class AdminController{
    private $renderer;
    private $model;
    private $pdfGenerator;

    public function __construct($render, $model, $pdfGenerator){
        $this->renderer = $render;
        $this->model = $model;
        $this->pdfGenerator = $pdfGenerator;
        if(!Router::checkAuth([4])){
            Redirect::redirect('/');
        };
    }

    public function list(){
        $data['usuarios'] = true;
        $data['listadoUsuarios'] = $this->model->getUsuarios();
        $this->renderer->render('admin.mustache', $data);
    }

    public function productos(){
        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $data['listaProductosBaja'] = $this->model->getProductosBaja();

        $this->renderer->render('admin.mustache', $data);
    }

    public function bajaProducto(){
        $id = $_GET['id'];

        $this->model->bajaProducto($id);
        Redirect::redirect('/admin/productos');
    }

    public function altaProducto(){
        $id = $_GET['id'];

        $this->model->altaProducto($id);
        Redirect::redirect('/admin/productos');
    }

    public function editorProducto() {
        $id = $_GET['id'];

        $data['productos'] = true;
        $data['editorProducto'] = true;

        $data['tipos'] = $this->model->getTiposProductos();
        $producto = $this->model->getProducto($id);

        $data['id'] = $producto[0]['id'];
        $data['nombre'] = $producto[0]['nombre'];
        $data['tipoOrig'] = $producto[0]['tipo'];
        $data['portadaOrig'] = $producto[0]['portada'];

        $this->renderer->render('admin.mustache', $data);
    }

    public function procesarEdicionProducto(){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $tipoNuevo = $_POST['tipoNuevo'];
        $tipoOrig = $_POST['tipoOrig'];
        $portadaOrig = $_POST['portadaOrig'];
        $nuevaPortadaName =  $_FILES['portada']['name'];
        $nuevaPortadaAbsolute = $_FILES['portada']['tmp_name'];

        $tipo = (!isset($tipoNuevo) || $tipoNuevo == '') ? $tipoOrig : $tipoNuevo;
        $portada = $portadaOrig;

        if(isset($nuevaPortadaName) && $nuevaPortadaName != ''){
            $portada = $nuevaPortadaName;
            move_uploaded_file($nuevaPortadaAbsolute, "public/images/".$nuevaPortadaName);
        }

        if($this->model->editarProducto($id, $nombre, $tipo, $portada)){
            Redirect::redirect('/admin/productos');
        } else {
            Redirect::redirect('/admin/editorProducto?id='.$id);
        }

    }

    public function ediciones(){
        $data['ediciones'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['listaEdicionesBaja'] = $this->model->getEdicionesBaja();
        $this->renderer->render('admin.mustache', $data);
    }

    public function contenidos(){
        $data['contenidos'] = true;
        $data['listaContenidos'] = $this->model->getContenidos();
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

    public function editorEdicion() {
        $id = $_GET['id'];

        $data['ediciones'] = true;
        $data['editorEdicion'] = true;

        $data['listaProductos'] = $this->model->getProductos();
        $edicion = $this->model->getEdicion($id);

        $data['id'] = $edicion[0]['id'];
        $data['edicion'] = $edicion[0]['edicion'];
        $data['fecha'] = $edicion[0]['fecha'];
        $data['precio'] = $edicion[0]['precio'];
        $data['productoOrig'] = $edicion[0]['producto'];
        $data['portadaOrig'] = $edicion[0]['portada'];

        $this->renderer->render('admin.mustache', $data);
    }

    public function procesarEdicion(){
        $id = $_POST['id'];
        $edicion = $_POST['edicion'];
        $precio = $_POST['precio'];
        $fecha = $_POST['fecha'];
        $productoNuevo = $_POST['productoNuevo'];
        $productoOrig = $_POST['productoOrig'];
        $portadaOrig = $_POST['portadaOrig'];
        $nuevaPortadaName =  $_FILES['portada']['name'];
        $nuevaPortadaAbsolute = $_FILES['portada']['tmp_name'];

        $producto = (!isset($productoNuevo) || $productoNuevo == '') ? $productoOrig : $productoNuevo;
        $portada = $portadaOrig;

        if(isset($nuevaPortadaName) && $nuevaPortadaName != ''){
            $portada = $nuevaPortadaName;
            move_uploaded_file($nuevaPortadaAbsolute, "public/images/".$nuevaPortadaName);
        }

        if($this->model->editarEdicion($id, $edicion, $fecha, $precio, $producto, $portada)){
            Redirect::redirect('/admin/ediciones');
        } else {
            Redirect::redirect('/admin/editorEdicion?id='.$id);
        }

    }

    public function bajaEdicion(){
        $id = $_GET['id'];

        $this->model->bajaEdicion($id);
        Redirect::redirect('/admin/ediciones');
    }

    public function altaEdicion(){
        $id = $_GET['id'];

        $this->model->altaEdicion($id);

        Redirect::redirect('/admin/ediciones');
    }

    public function detalleContenido() {
        $id = $_GET['id'];

        $data['contenidos'] = true;
        $data['detalleContenido'] = $this->model->detalleContenido($id);

        return $this->renderer->render('admin.mustache', $data);
    }

    public function bajaContenido() {
        $id = $_GET['id'];
        $this->model->bajaContenido($id);

        Redirect::redirect('/admin/contenidos');
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
        $data['estado'] = $usuario[0]['estado'];

        $this->renderer->render('admin.mustache', $data);

    }

    public function editUsuario(){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $latitud  = $_POST["latitud"];
        $longitud  = $_POST["longitud"];
        $role  = $_POST["role"];
        $estado = $_POST["estado"];

        if($_POST["roleEdit"]){ $role  = $_POST["roleEdit"]; }

        $this->model->editUsuario($id, $name, $mail, $latitud, $longitud, $role, $estado);

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
        $html = $this->renderer->getHtml('reportesPdf/templatePdfProductos.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-contenidistas');
    }

    public function graficos(){

        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];

        $data ['fechaInicio'] = $fechaInicio;
        $data ['fechaFin'] = $fechaFin;

        $data ['suscripciones'] = json_encode($this->model->getProductosReporteGraficoTorta($fechaInicio, $fechaFin));

        $data['graficos'] = true;

        $this->renderer->render('admin.mustache', $data);
    }

}