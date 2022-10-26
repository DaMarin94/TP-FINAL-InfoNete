<?php

class Router{
    private $configuration;
    private $defaultController;
    private $defaultMethod;

    public function __construct($configuration, $defaultControllerName, $defaultMethod)
    {
        $this->configuration = $configuration;
        $this->defaultController = $defaultControllerName;
        $this->defaultMethod = $defaultMethod;
    }

    public function redirect($controllerName = "", $methodName = ""){
        $controller = $this->getControllerFrom($controllerName);
        $this->executeMethodFrom($controller, $methodName);
    }

    //PARA QUE ESTO FUNCIONE, LA ESTRUCTURA DE NOMBRES DEBE RESPETARSE
    private function getControllerFrom($controllerName){
        $controllerName = $this->getFullControllerName($controllerName);
        $validControllerName = method_exists($this->configuration, $controllerName) ? $controllerName : $this->getFullControllerName($this->defaultController); //method_exists -> se fija si existe el metodo
        return call_user_func(array($this->configuration, $validControllerName)); //call_user_func ->llama una funcion de una clase
    }

    private function executeMethodFrom($controller, $methodName){
        $validMethod = method_exists($controller, $methodName) ? $methodName : $this->defaultMethod; //method_exists -> se fija si existe el metodo
        return call_user_func(array($controller, $validMethod));
    }

    private function getFullControllerName($controllerName): string{
        return "get" . ucfirst($controllerName) . "Controller"; // ucfirst -> convierte la primera letra en mayuscula
    }

}