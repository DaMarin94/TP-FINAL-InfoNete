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
            Redirect::redirect("productos");
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
            $data['exito'] = "Seccion agregada con exito";
            $this->renderer->render('contenidista.mustache', $data);
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
            Redirect::redirect("ediciones");
        }
    }

    public function noticias()
    {
        $data['noticias'] = true;
        $data['listaNoticias'] = $this->model->getNoticias();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function productos()
    {
        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function ediciones()
    {
        $data['ediciones'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $this->renderer->render('contenidista.mustache', $data);
    }
}


