<?php

class Render{
    private $mustache;
    private $viewFolder;

    public function __construct($viewFolder, $partialsPathLoader){
        $this->viewFolder = $viewFolder;

        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
            'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialsPathLoader )
        ));
    }

    public function render($viewName , $datos = array() ){
        $contentAsString =  file_get_contents($this->viewFolder . $viewName);
        echo $this->mustache->render($contentAsString, $datos);
    }
}