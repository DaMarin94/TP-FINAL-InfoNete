<?php

class InfoneteController {

    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list() {
        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('infonete.mustache', $data);
    }

    public function producto(){
        $data['ediciones'] = true;
        $idProducto = $_GET['id'];
        $data['producto'] = $this->model->getProductoPorId($idProducto);
        $data['listaEdiciones'] = $this->model->getEdicionesPorProducto($idProducto);
        $this->renderer->render('infonete.mustache', $data);
    }

    public function edicion(){
        $data['edicion'] = true;
        $idEdicion = $_GET['id'];
        $idSeccion= $_GET['ids'];

        $data['idEdicion'] = $idEdicion;
        $data['edicion'] = $this->model->getEdicionPorId($idEdicion);
        $data['listaSecciones'] = $this->model->getSeccionesPorEdicion($idEdicion);

        $data['contenido'] = $this->model->getContenidoPorEdicionSeccion($idEdicion, $idSeccion);

        $this->renderer->render('infonete.mustache', $data);
    }

    public function cerrarSesion(){
        session_destroy();
        Redirect::redirect('/login');
    }

}