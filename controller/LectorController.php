<?php

class LectorController
{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function validarRol(){
        if(!Router::checkAuth([1])){
            Redirect::redirect('/');
        };
    }

    public function list(){
        $this->validarRol();

        $this->misProductos();
    }

    public function misProductos(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];

        $data['productosSuscrito'] = true;
        $data['listaProductosSuscrito'] = $this->model->getProductosSuscrito($usuario);
        $this->renderer->render('lector.mustache', $data);
    }

    public function misEdiciones(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];

        $data['edicionesSuscrito'] = true;
        $data['listaEdicionesSuscrito'] = $this->model->getEdicionesSuscrito($usuario);

        $data['edicionesCompradas'] = true;
        $data['listaEdicionesCompradas'] = $this->model->getEdicionesCompradas($usuario);

        $this->renderer->render('lector.mustache', $data);
    }

    public function misSuscripciones(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];

        $data['suscripciones'] = true;
        $data['listaSuscripciones'] = $this->model->getSuscripciones($usuario);
        $this->renderer->render('lector.mustache', $data);
    }

    public function misNoticias(){
        $this->validarRol();

        $usuario = $_SESSION['id_user'];

        $data['noticiasSuscrito'] = true;
        $data['listaNoticiasSuscrito'] = $this->model->getNoticiasSuscrito($usuario);

        $data['noticiasCompradas'] = true;
        $data['listaNoticiasCompradas'] = $this->model->getNoticiasCompradas($usuario);

        $this->renderer->render('lector.mustache', $data);
    }

}