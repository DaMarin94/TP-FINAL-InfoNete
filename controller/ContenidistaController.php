<?php

class ContenidistaController
{

    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list()
    {
        if(!Router::checkAuth([2])){
            Redirect::redirect('/');
        };
        $data['noticias'] = true;
        $data['listaNoticias'] = $this->model->getNoticias();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function formularioNoticia(){
        $data['formAltaNoticia'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['listaSecciones'] = $this->model->getSecciones();
        echo $this->renderer->render("contenidista.mustache", $data);
    }

    public function procesarNoticia()
    {
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        $imagen =  $_FILES['imagen']['name'];
        $portada = $_FILES['imagen']['tmp_name'];
        $contenido  = $_POST["contenido"];

        $seccion = $_POST["seccion"];
        $edicion = $_POST["edicion"];

        if(!empty($titulo) && !empty($subtitulo) && !empty($imagen) && !empty($contenido) && !empty($seccion) && !empty($edicion)){
            move_uploaded_file($portada, "public/images/".$imagen);
            $this->model->altaNoticia($titulo, $subtitulo, $imagen, $contenido, $seccion, $edicion);
            Redirect::redirect("noticias");
        };
    }

    public function formularioProducto(){
        $data['formAltaProducto'] = true;
        $data['tipos'] = $this->model->getTipos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarProducto(){
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];

        $imagen =  $_FILES['portada']['name'];
        $portada = $_FILES['portada']['tmp_name'];

        if(!empty($nombre) && !empty($tipo) && !empty($imagen)){
            move_uploaded_file($portada, "public/images/".$imagen);
            $this->model->altaProducto($nombre, $tipo, $imagen);
            Redirect::redirect("misproductos");
        } else {
            Redirect::redirect("formularioProducto");
        }
    }

    public function formularioEdicion(){
        $data['formAltaEdicion'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarEdicion(){
        $edicion = $_POST["edicion"];
        $precio = $_POST["precio"];
        $producto = $_POST["producto"];

        $imagen =  $_FILES['portada']['name'];
        $portada = $_FILES['portada']['tmp_name'];

        if(!empty($edicion) && !empty($precio) && !empty($producto) && !empty($imagen)){
            move_uploaded_file($portada, "public/images/".$imagen);
            $this->model->altaEdicion($edicion, $precio, $producto, $imagen);
            Redirect::redirect("producto?id=$producto");
        } else {
            Redirect::redirect("formularioEdicion");
        }
    }

    public function formularioSeccion(){
        $data['formAgregarSeccion'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['listaSecciones'] = $this->model->getSecciones();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarSeccion(){
        $edicion = $_POST["edicion"];
        $seccion = $_POST["seccion"];

        if(!empty($edicion) && !empty($seccion)){
            $this->model->altaSeccion($edicion, $seccion);
            Redirect::redirect("edicion?id=$edicion");
        }
    }

    public function misnoticias()
    {
        $data['noticias'] = true;
        $data['listaNoticias'] = $this->model->getNoticias();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function misproductos()
    {
        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function edicion()
    {
        $data['edicion'] = true;
        $idEdicion = $_GET['id'];
        $data['nombre'] = $this->model->getNombreEdicionById($idEdicion);
        $data['listaSecciones'] = $this->model->getSeccionesByEdicion($idEdicion);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function producto()
    {
        $data['ediciones'] = true;
        $idProducto = $_GET['id'];
        $data['nombre'] = $this->model->getNombreProductoById($idProducto);
        $data['listaEdiciones'] = $this->model->getEdicionesByProducto($idProducto);
        $this->renderer->render('contenidista.mustache', $data);
    }
}


