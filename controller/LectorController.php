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

        $data['productosSuscrito'] = true;
        $data['listaProductosSuscrito'] = $this->model->getProductosSuscrito($usuario);
        $this->renderer->render('lector.mustache', $data);
    }

    public function misEdiciones(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];

        $data['edicionesSuscrito'] = true;
        $data['listaEdicionesSuscrito'] = $this->model->getEdicionesSuscrito($usuario);

        $data['edicionesCompradas'] = true;
        $data['listaEdicionesCompradas'] = $this->model->getEdicionesCompradas($usuario);

        $this->renderer->render('lector.mustache', $data);
    }

    public function misSuscripciones(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];

        $data['suscripciones'] = true;
        $data['listaSuscripciones'] = $this->model->getSuscripciones($usuario);
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

}