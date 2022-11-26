<?php

class LectorController
{

    private $renderer;
    private $model;
    private $pdfGenerator;

    public function __construct($render, $model, $pdfGenerator)
    {
        $this->renderer = $render;
        $this->model = $model;
        $this->pdfGenerator = $pdfGenerator;

        if (!Router::checkAuth([1])) {
            Redirect::redirect('/');
        };
    }

    public function list()
    {
        $this->biblioteca();
    }

    public function biblioteca()
    {
        $usuario = $_SESSION['id_user'];

        $data['biblioteca'] = true;
        $data['edicionesSuscrito'] = $this->model->getEdicionesSuscrito($usuario);
        $data['edicionesCompradas'] = $this->model->getEdicionesCompradas($usuario);

        $this->renderer->render('lector.mustache', $data);
    }

    public function misPagos()
    {
        //mensajes de error por si no selecciona fecha
        $data['errorSuscripciones'] = $this->mensajeErrorSuscripciones();
        $data['errorCompras'] = $this->mensajeErrorCompras();

        $usuario = $_SESSION['id_user'];

        $data['compras'] = true;
        $data['listaSuscripciones'] = $this->model->getSuscripciones($usuario);
        $data['listaCompras'] = $this->model->getCompras($usuario);
        $this->renderer->render('lector.mustache', $data);
    }

    public function getPdfSuscripciones()
    {
        $usuario = $_SESSION['id_user'];

        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];

        if ($fechaInicio != null && $fechaFin != null) {
            $data['listaSuscripciones'] = $this->model->getSuscripcionesPDF($usuario, $fechaInicio, $fechaFin);

            $html = $this->renderer->getHtml('reportesPdf/templatePdfLectorSuscripciones.mustache', $data);
            $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-suscripciones');

        } else {
            $this->errorFechaSuscripciones();
        }
    }

    public function getPdfCompras() {
        $usuario = $_SESSION['id_user'];

        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];

        if($fechaInicio!= null && $fechaFin != null){

        $data['listaCompras'] = $this->model->getComprasPDF($usuario, $fechaInicio, $fechaFin);

        $html = $this->renderer->getHtml('reportesPdf/templatePdfLectorCompras.mustache', $data);
        $this->pdfGenerator->generarPdf($html, 'portrait', 'reporte-compras');

        }else{
            $this->errorFechaCompras();
        }
    }

    public function errorFechaCompras(){
        Redirect::redirect("misPagos?error=fechaCompras");
    }

    public function mensajeErrorCompras(){
        $mensaje = "";
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "fechaCompras") {
                $mensaje = "Seleccione un rango de fechas";
            }
            return $mensaje;
        }
    }

    public function errorFechaSuscripciones()
    {
        Redirect::redirect("misPagos?error=fechaSuscripciones");
    }

    public function mensajeErrorSuscripciones()
    {
        $mensaje = "";
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "fechaSuscripciones") {
                $mensaje = $mensaje . "Seleccione un rango de fechas";
            }
            return $mensaje;
        }
    }

}