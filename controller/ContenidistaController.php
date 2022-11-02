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

    public function formNoticia(){
        $data['formAltaNoticia'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['listaSecciones'] = $this->model->getSecciones();
        echo $this->renderer->render("contenidista.mustache", $data);
    }

    public function procesarAlta()
    {
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        $imagen  = $_POST["imagen"];
        $contenido  = $_POST["contenido"];
        $seccion = $_POST["seccion"];
        $edicion = $_POST["edicion"];

        if($this->model->altaNoticia($titulo, $subtitulo, $imagen, $contenido, $seccion, $edicion)){
            Redirect::redirect("noticias");
        };
    }

    public function formProducto(){
        $data['formAltaProducto'] = true;
        $data['tipos'] = $this->model->getTipos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarProducto(){
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];

        if($this->model->altaProducto($nombre, $tipo)){
            Redirect::redirect("misproductos");
        }
    }

    public function formSeccion(){
        $data['formAgregarSeccion'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['listaSecciones'] = $this->model->getSecciones();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarSeccion(){
        $edicion = $_POST["edicion"];
        $seccion = $_POST["seccion"];

        if($this->model->altaSeccion($edicion, $seccion)){
            Redirect::redirect("edicion?id=$edicion");
        }
    }

    public function formEdicion(){
        $data['formAltaEdicion'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarEdicion(){
        $edicion = $_POST["edicion"];
        $precio = $_POST["precio"];
        $producto = $_POST["producto"];

        if($this->model->altaEdicion($edicion, $precio, $producto)){
            Redirect::redirect("producto?id=$producto");
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


