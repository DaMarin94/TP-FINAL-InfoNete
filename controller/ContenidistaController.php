<?php

class ContenidistaController
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
        $this->view->render('contenidistaForm.mustache');
    }

    public function alta(){
        echo $this->renderer->render("contenidistaForm.mustache");
    }

    public function procesarAlta()
    {
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        $imagen  = $_POST["imagen"];
        $contenido  = $_POST["contenido"];

        if($this->model->alta($titulo, $subtitulo, $imagen, $contenido)){
            echo "bien";
            Redirect::redirect('/');
        };
    }
}