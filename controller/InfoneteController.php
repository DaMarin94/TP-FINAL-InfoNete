<?php

class InfoneteController {

    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list() {
        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
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

        $data['contenido'] = $this->model->getContenidoSuscritoPorEdicionSeccion($usuario, $idSeccion, $idEdicion);

        $data['contenido'] = $this->model->getContenidoCompradoPorEdicionSeccion($usuario, $idSeccion, $idEdicion);

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

    public function cerrarSesion(){
        session_destroy();
        Redirect::redirect('/login');
    }
}