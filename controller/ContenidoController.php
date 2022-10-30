<?php

class ContenidoController {

    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list() {
        $id = $_GET["id"];
        $data["contenido"] = $this->model->getContenidoPorId($id);
        $this->renderer->render('contenido.mustache', $data);
    }

}