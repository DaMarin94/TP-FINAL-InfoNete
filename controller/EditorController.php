<?php

class EditorController{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
        if(!Router::checkAuth([3])){
            Redirect::redirect('/');
        };
    }

    public function list(){
        $this->contenidos();
    }

    public function contenidos(){
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

    public function verificar(){
        $data['verificar'] = true;
        $data['listaContenidosVerificar'] = $this->model->getVerificar();
        $this->renderer->render('editor.mustache', $data);
    }
}