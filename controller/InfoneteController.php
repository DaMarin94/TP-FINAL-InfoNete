<?php
/*
// SDK de Mercado Pago
require 'vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-1735674503019884-032202-d54a673969e467b857cf50292aaedaa6-201226814');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();
*/

class InfoneteController {

    private $renderer;
    private $model;
    private $clima;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
        $this->clima = Clima::getClima();
    }

    public function iraPerfil(){
        switch($_SESSION['usuario'][0]['role']){
            case 4:
                Redirect::redirect('/admin');
                break;
            case 3:
                Redirect::redirect('/editor');
                break;
            case 2:
                Redirect::redirect('/contenidista');
                break;
            case 1:
                Redirect::redirect('/lector');
                break;
            default:
                Redirect::redirect('/');
                break;
        }
    }

    public function mostrarClima(){
        $this->validarRol();
    }

    public function cerrarSesion(){
        session_destroy();
        Redirect::redirect('/login');
    }

    public function list() {
        //mensajes si se hizo o no la suscripcion
        $data['exitoSuscripcion'] = $this->mensajeSuscripcionExitosa();
        $data['errorSuscripcion'] = $this->mensajeSuscripcionError();

        //mensajes si se hizo o no la compra
        $data['exitoCompra'] = $this->mensajeCompraExitosa();
        $data['errorCompra'] = $this->mensajeCompraError();

        //mensaje por si no esta logueado
        $data['errorUsuario'] = $this->mensajeUsuarioError();

        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $data['clima'] = $this->clima;

        $this->renderer->render('infonete.mustache', $data);
    }

    public function producto(){

        $data['ediciones'] = true;
        $idProducto = $_GET['id'];
        $data['producto'] = $this->model->getProductoPorId($idProducto);
        $data['listaEdiciones'] = $this->model->getEdicionesPorProducto($idProducto);

        $this->renderer->render('infonete.mustache', $data);
    }

    public function suscribirseProducto(){
        $idProducto = $_POST['id_producto'];
        $usuario = $_SESSION['id_user'];

        if($this->model->suscribirseProducto($idProducto, $usuario)){
            $this->exitoSuscripcion();
        }
        $this->errorSuscripcion();
    }

    public function edicion(){
        $data['edicion'] = true;
        $idEdicion = $_GET['id'];
        $idSeccion= $_GET['ids'];
        $usuario = $_SESSION['id_user'];

        $data['idEdicion'] = $idEdicion;
        $data['edicion'] = $this->model->getEdicionPorId($idEdicion);

        if($usuario == null){
            $this->errorUsuario();
        }

        if($this->model->getEdicionComprada($idEdicion, $usuario) || $this->model->getProductoSuscrito($idEdicion, $usuario)){
            $data['listaSecciones'] = $this->model->getSeccionesPorEdicion($idEdicion);
        }

        $data['contenido'] = $this->model->getContenidoEdicionSeccion($idSeccion, $idEdicion);

        $this->renderer->render('infonete.mustache', $data);
    }

    public function comprarEdicion(){
        $idEdicion = $_POST['id_edicion'];
        $usuario = $_SESSION['id_user'];

        if($this->model->comprarEdicion($idEdicion, $usuario)){
            $this->exitoCompra();
        }
        $this->errorCompra();
    }

    public function exitoCompra(){
        Redirect::redirect("/?exito=compraExitosa");
    }

    public function mensajeCompraExitosa(){
        $mensaje = "";
        if (isset($_GET["exito"])) {
            if ($_GET["exito"] == "compraExitosa") {
                $mensaje = $mensaje . "La compraste con éxito!";
            }
            return $mensaje;
        }
    }

    public function errorCompra(){
        Redirect::redirect("/?error=compraError");
    }

    public function mensajeCompraError(){
        $mensaje = "";
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "compraError") {
                $mensaje = $mensaje . "Ya tenés esa edición!";
            }
            return $mensaje;
        }
    }

    public function exitoSuscripcion(){
        Redirect::redirect("/?exito=suscripcionExitosa");
    }

    public function mensajeSuscripcionExitosa(){
        $mensaje = "";
        if (isset($_GET["exito"])) {
            if ($_GET["exito"] == "suscripcionExitosa") {
                $mensaje = $mensaje . "Te suscribiste con éxito!";
            }
            return $mensaje;
        }
    }

    public function errorSuscripcion(){
        Redirect::redirect("/?error=suscripcionError");
    }

    public function mensajeSuscripcionError(){
        $mensaje = "";
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "suscripcionError") {
                $mensaje = $mensaje . "Ya tenés una suscripción activa!";
            }
            return $mensaje;
        }
    }

    public function errorUsuario(){
        Redirect::redirect("/?error=usuarioError");
    }

    public function mensajeUsuarioError(){
        $mensaje = "";
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "usuarioError") {
                $mensaje = $mensaje . "Solo los usuarios pueden ver o comprar contenido!";
            }
            return $mensaje;
        }
    }

}