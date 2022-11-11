<?php

class ContenidoEditController
{
    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list() {
        $id = $_GET["id"];
        $data['contenidoEdit'] = true;
        $data['reportesEdit'] = true;
        $data['tipos'] = true;
        $data["contenidoEdit"] = $this->model->getContenidoPorId($id);
        $data["reportesEdit"] = $this->model->getReportesEdit($id);
        $data['tipos'] = $this->model->getTipos();
        $this->renderer->render('contenidoedit.mustache', $data);
    }

    public function alta() {
        $id = $_GET["id"];
        $estado = $_GET["estado"];
        $comentario = $_GET["comentario"];
        $contenidista = $_GET["contenidista"];

        if($this->model->alta($id, $contenidista, $comentario, $estado)){
            Redirect::redirect('/editor/misContenidos');
        }else{
            Redirect::redirect('/editor');
        }
    }
}