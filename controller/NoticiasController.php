<?php

class NoticiasController
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
        echo "ACA DEBERIAMOS HACER LAS QUERYS PARA TRAER NORICIAS";
        $data['noticias'] = $this->model->getNoticias();
        $this->view->render('noticias.mustache', $data);
    }
}