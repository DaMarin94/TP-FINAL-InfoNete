<?php

class InfoneteController {

    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list() {
        $data["contenido"] = $this->model->getContenido();
        $this->renderer->render('infonete.mustache', $data);
    }

    public function cerrarSesion(){
        $_SESSION['usuario'] = null;
        Redirect::redirect('/');
    }

}