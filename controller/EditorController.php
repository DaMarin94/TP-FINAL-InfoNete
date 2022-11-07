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
        if(!Router::checkAuth([3])){
            Redirect::redirect('/');
        };
        $data['contenidos'] = true;
        $data['listaContenidos'] = $this->model->getContenidos();
        $this->renderer->render("editor.mustache", $data);
    }

    public function misContenidos(){
        $data['miscontenidos'] = true;
        $data['listaContenidosPendientes'] = $this->model->getContenidosNuevos();
        $this->renderer->render('editor.mustache', $data);
    }

    public function reportes(){
        $data['reportes'] = true;
        $data['listaContenidosReportes'] = $this->model->getContenidosReportados();
        $this->renderer->render('editor.mustache', $data);
    }
}