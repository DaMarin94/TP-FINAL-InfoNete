<?php
include_once ("helper/Redirect.php");
include_once("helper/MysqlDatabase.php");
include_once("helper/Router.php");
include_once("helper/Render.php");

include_once("model/LoginModel.php");
include_once("model/RegistroModel.php");
include_once("model/NoticiasModel.php");
include_once("model/ContenidistaModel.php");

include_once("controller/InfoneteController.php");
include_once("controller/LoginController.php");
include_once("controller/RegistroController.php");
include_once("controller/NoticiasController.php");
include_once("controller/ContenidistaController.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');


class Configuration{

    private $database;
    private $view;

    public function __construct(){
        $this->database = new MysqlDatabase();
        $this->view = new Render("view/", "view/partial/");
    }

    public function getInfoneteController(){
        return new InfoneteController($this->view);
    }

    public function getLoginController(){
        return new LoginController($this->view, $this->getLoginModel());
    }

    public function getRegistroController(){
        return new RegistroController($this->view, $this->getRegistroModel());
    }

    public function getNoticiasController(){
        return new NoticiasController($this->view, $this->getNoticiasModel());
    }

    public function getContenidistaController(){
        return new ContenidistaController($this->view, $this->getContenidistaModel());
    }

    public function getLoginModel(){
        return new LoginModel($this->database);
    }

    public function getRegistroModel(){
        return new RegistroModel($this->database);
    }

    public function getNoticiasModel(){
        return new NoticiasModel($this->database);
    }

    public function getContenidistaModel(){
        return new ContenidistaModel($this->database);
    }

    public function getRouter(){
        //Se llama a si mismo para referenciarse
        return new Router($this, "infonete", "list");
    }

}