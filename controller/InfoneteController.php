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

    public function list() {
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

        $this->model->suscribirseProducto($idProducto, $usuario);
        Redirect::redirect('/');
    }

    public function edicion(){
        $data['edicion'] = true;
        $idEdicion = $_GET['id'];
        $idSeccion= $_GET['ids'];
        $usuario = $_SESSION['id_user'];

        $data['idEdicion'] = $idEdicion;
        $data['edicion'] = $this->model->getEdicionPorId($idEdicion);
        $data['listaSecciones'] = $this->model->getSeccionesPorEdicion($idEdicion);

        if($usuario ==null){
            Redirect::redirect('/');
        }

        $data['contenidoSuscrito'] = $this->model->getContenidoSuscritoPorEdicionSeccion($usuario, $idSeccion, $idEdicion);
        $data['contenidoComprado'] = $this->model->getContenidoCompradoPorEdicionSeccion($usuario, $idSeccion, $idEdicion);

        $data['contenido'] = array_unique(array_merge($data['contenidoSuscrito'],  $data['contenidoComprado']),0);

        /*if($idSeccion != null){
            $idContenido = $data['contenido'][0]['id'];
            $data['multimedia'] = $this->model->getMultimediaByContenido($idContenido);
        }*/

        $this->renderer->render('infonete.mustache', $data);
    }

    public function comprarEdicion(){
        $idEdicion = $_POST['id_edicion'];
        $usuario = $_SESSION['id_user'];

        $this->model->comprarEdicion($idEdicion, $usuario);
        Redirect::redirect('/');
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

}