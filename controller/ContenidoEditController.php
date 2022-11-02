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
        $data["contenidoEdit"] = $this->model->getContenidoPorId($id);
        $this->renderer->render('contenidoedit.mustache', $data);
    }
}