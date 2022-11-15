<?php

class EditorController
{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function validarRol(){
        if(!Router::checkAuth([3])){
            Redirect::redirect('/');
        };
    }

    public function list(){
        $this->validarRol();

        $data['contenidos'] = true;
        $data['listaContenidos'] = $this->model->getContenidos();
        $this->renderer->render("editor.mustache", $data);
    }

    public function misContenidos(){
        $this->validarRol();

        $data['miscontenidos'] = true;
        $data['listaContenidosPendientes'] = $this->model->getContenidosNuevos();
        $this->renderer->render('editor.mustache', $data);
    }

    public function reportes(){
        $this->validarRol();

        $data['reportes'] = true;
        $data['listaContenidosReportes'] = $this->model->getContenidosReportados();
        $this->renderer->render('editor.mustache', $data);
    }

    public function verificar(){
        $this->validarRol();

        $data['verificar'] = true;
        $data['listaContenidosVerificar'] = $this->model->getVerificar();
        $this->renderer->render('editor.mustache', $data);
    }
}