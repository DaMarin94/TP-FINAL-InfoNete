<?php

class LectorController
{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list(){
        if(!Router::checkAuth([1])){
            Redirect::redirect('/');
        };
        $this->misProductos();
    }

    public function misEdiciones(){
        $usuario = $_SESSION['id_user'];

        $data['ediciones'] = true;
        $data['listaEdicionesCompradas'] = $this->model->getEdicionesCompradas($usuario);

        $data['comprasEdiciones'] = true;
        $data['listaCompras'] = $this->model->getCompras($usuario);

        $this->renderer->render('lector.mustache', $data);
    }

    public function misProductos(){
        $usuario = $_SESSION['id_user'];

        $data['productos'] = true;
        $data['listaProductosComprados'] = $this->model->getProductosComprados($usuario);
        $this->renderer->render('lector.mustache', $data);
    }

    public function misSuscripciones(){
        $usuario = $_SESSION['id_user'];

        $data['suscripciones'] = true;
        $data['listaSuscripciones'] = $this->model->getSuscripciones($usuario);
        $this->renderer->render('lector.mustache', $data);
    }

    public function misNoticias(){
        $usuario = $_SESSION['id_user'];

        $data['noticias'] = true;
        $data['listaNoticiasSuscrito'] = $this->model->getNoticiasSuscrito($usuario);

        $data['comprasNoticias'] = true;
        $data['listaNoticiasCompradas'] = $this->model->getNoticiasCompradas($usuario);

        $this->renderer->render('lector.mustache', $data);
    }

}