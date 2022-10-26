<?php
include_once("helper/Configuration.php");

session_start();

$configuration = new Configuration();
$router = $configuration->getRouter();

//CON ESTO PODEMOS PONER DIRECTO EN LA URL controller/method, si necesitamos pasar cosas por get usamos $_SESSION
$router->redirect($_GET['controller'], $_GET['method']);