<?php

class LectorController{

    private $renderer;
    private $model;
    private $pdfGenerator;

    public function __construct($render, $model, $pdfGenerator){
        $this->renderer = $render;
        $this->model = $model;
        $this->pdfGenerator = $pdfGenerator;
    }

    public function validarRol(){
        if(!Router::checkAuth([1])){
            Redirect::redirect('/');
        };
    }

    public function list(){
        $this->validarRol();

        $this->misProductos();
    }

    public function misProductos(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];
        $data['listaProductosSuscrito'] = $this->model->getProductosSuscrito($usuario);
        $data['listaProductosCompras'] = $this->model->getProductosCompras($usuario);

        $data['productos'] = true;

        $data['listaProductos'] = array_unique(array_merge($data['listaProductosSuscrito'], $data['listaProductosCompras']),0);

        $this->renderer->render('lector.mustache', $data);
    }

    public function producto(){
        $this->validarRol();

        $idProducto = $_GET['id'];
        $usuario = $_SESSION['id_user'];

        $data['producto'] = $this->model->getProductoPorId($idProducto);
        $data['listaEdicionesSuscrito'] = $this->model->getEdicionesSuscrito($usuario, $idProducto);
        $data['listaEdicionesCompradas'] = $this->model->getEdicionesCompradas($usuario, $idProducto);

        $data ['ediciones'] = true;
        $data['listaEdiciones'] = array_merge($data['listaEdicionesCompradas'], $data['listaEdicionesSuscrito']);

        $this->renderer->render('lector.mustache', $data);
    }

    public function misCompras(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];

        $data['compras'] = true;
        $data['listaSuscripciones'] = $this->model->getSuscripciones($usuario);
        $data['listaCompras'] = $this->model->getCompras($usuario);
        $this->renderer->render('lector.mustache', $data);
    }

    public function misNoticias(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];

        $data['noticiasSuscrito'] = true;
        $data['listaNoticiasSuscrito'] = $this->model->getNoticiasSuscrito($usuario);

        $data['noticiasCompradas'] = true;
        $data['listaNoticiasCompradas'] = $this->model->getNoticiasCompradas($usuario);

        $this->renderer->render('lector.mustache', $data);
    }

    public function getPdfSuscripciones() {
        $this->validarRol();

        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];

        $usuario = $_SESSION['id_user'];
        $data['listaSuscripciones'] = $this->model->getSuscripcionesPDF($usuario, $fechaInicio, $fechaFin);


        $html = $this->renderer->getHtml('reportesPdf/templatePdfLectorSuscripciones.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-suscripciones');
    }

    public function getPdfCompras() {
        $this->validarRol();

        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];

        $usuario = $_SESSION['id_user'];
        $data['listaCompras'] = $this->model->getComprasPDF($usuario, $fechaInicio, $fechaFin);

        $html = $this->renderer->getHtml('reportesPdf/templatePdfLectorCompras.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-compras');
    }

}