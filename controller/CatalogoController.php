<?php

class CatalogoController {

    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list() {
        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('catalogo.mustache', $data);
    }

    public function producto(){
        $data['ediciones'] = true;
        $idProducto = $_GET['id'];
        $data['nombre'] = $this->model->getNombreProductoPorId($idProducto);
        $data['listaEdiciones'] = $this->model->getEdicionesPorProducto($idProducto);
        $this->renderer->render('catalogo.mustache', $data);
    }

    public function edicion(){
        $data['edicion'] = true;
        $idEdicion = $_GET['id'];
        $data['nombre'] = $this->model->getNombreEdicionPorId($idEdicion);
        $data['listaSecciones'] = $this->model->getSeccionesPorEdicion($idEdicion);
        $this->renderer->render('catalogo.mustache', $data);
    }

    public function seccion(){
        $data['seccion'] = true;

        $idSeccion = $_GET['id'];
        $idEdicion = $_GET['id'];//deberia traer el id de la edicion

        $data['descripcion'] = $this->model->getNombreSeccionPorId($idSeccion);
        $data['listaContenido'] = $this->model->getContenidoPorEdicionSeccion($idSeccion, $idEdicion);
        $this->renderer->render('catalogo.mustache', $data);
    }

    public function contenido(){
        $data['contenido'] = true;
        $idContenido = $_GET['id'];
        $data["contenido"] = $this->model->getContenidoPorId($idContenido);
        $this->renderer->render('catalogo.mustache', $data);
    }

}