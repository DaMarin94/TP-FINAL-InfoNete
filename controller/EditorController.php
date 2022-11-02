<?php

class EditorController {

    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list() {
        if(!Router::checkAuth([3])){
            Redirect::redirect('/');
        };
        $this->renderer->render('editor.mustache');
    }

}