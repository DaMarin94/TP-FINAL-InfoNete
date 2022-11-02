<?php

class EditorController
{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list(){
        $data['contenidos'] = true;
        $data['listaContenidosPendientes'] = $this->model->getContenidos();
        $this->renderer->render("editor.mustache", $data);
    }

    public function misContenidos(){
        $data['contenidos'] = true;
        $data['listaContenidosPendientes'] = $this->model->getContenidos();
        $this->renderer->render('editor.mustache', $data);
    }

    public function reportes(){
        $data['reportes'] = true;
        echo $this->renderer->render('editor.mustache', $data);
    }
}