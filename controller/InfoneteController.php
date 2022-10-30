<?php

class InfoneteController{
    private $renderer;

    public function __construct($render){
        $this->renderer = $render;
    }
    public function list(){
        $this->renderer->render('infonete.mustache');
    }

    public function cerrarSesion(){
        $_SESSION['usuario'] = null;
        Redirect::redirect('/');
    }

}