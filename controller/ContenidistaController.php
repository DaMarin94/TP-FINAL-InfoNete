<?php

class ContenidistaController
{

    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list()
    {
        if(!Router::checkAuth([2])){
            Redirect::redirect('/');
        };
        $data['noticias'] = true;
        $data['listaNoticias'] = $this->model->getNoticiasByAutor($_SESSION['usuario'][0]['id']);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function formularioNoticia(){
        $data['formAltaNoticia'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['listaSecciones'] = $this->model->getSecciones();
        echo $this->renderer->render("contenidista.mustache", $data);
    }

    public function procesarNoticia()
    {
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];

        $contenido  = $_POST["contenido"];
        $seccion = $_POST["seccion"];
        $edicion = $_POST["edicion"];

        $latitud = $_POST["latitud"];
        $longitud = $_POST["longitud"];

        if($this->validarNoticia()) {
            $idMultimedia = $this->model->procesarMultimedia();
            $this->model->altaNoticia($titulo, $subtitulo, $idMultimedia, $contenido, $seccion, $edicion, $latitud, $longitud);
            Redirect::redirect("noticias");
        } else {
            Redirect::redirect("formularioNoticias");
        }
    }

    public function editarNoticia(){
        $noticia = $_GET["id"];
        $data['editarNoticia'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['listaSecciones'] = $this->model->getSecciones();
        $data['datosNoticia'] = $this->model->getDatosNoticia($noticia);
        $data['datosMultimedia'] = $this->model->getMultimediaByNoticia($noticia);
        echo $this->renderer->render("contenidista.mustache", $data);
    }

    public function formularioProducto(){
        $data['formAltaProducto'] = true;
        $data['tipos'] = $this->model->getTipos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarProducto(){
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];

        $imagen =  $_FILES['portada']['name'];
        $portada = $_FILES['portada']['tmp_name'];

        if(!empty($nombre) && !empty($tipo) && !empty($imagen)){
            move_uploaded_file($portada, "public/images/".$imagen);
            $this->model->altaProducto($nombre, $tipo, $imagen);
            Redirect::redirect("misproductos");
        } else {
            Redirect::redirect("formularioProducto");
        }
    }

    public function formularioEdicion(){
        $data['formAltaEdicion'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarEdicion(){
        $edicion = $_POST["edicion"];
        $precio = $_POST["precio"];
        $producto = $_POST["producto"];

        $imagen =  $_FILES['portada']['name'];
        $portada = $_FILES['portada']['tmp_name'];

        if(!empty($edicion) && !empty($precio) && !empty($producto) && !empty($imagen)){
            move_uploaded_file($portada, "public/images/".$imagen);
            $this->model->altaEdicion($edicion, $precio, $producto, $imagen);
            Redirect::redirect("producto?id=$producto");
        } else {
            Redirect::redirect("formularioEdicion");
        }
    }

    public function formularioSeccion(){
        $data['formAgregarSeccion'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['listaSecciones'] = $this->model->getSecciones();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarSeccion(){
        $edicion = $_POST["edicion"];
        $seccion = $_POST["seccion"];

        if(!empty($edicion) && !empty($seccion)){
            $this->model->altaSeccion($edicion, $seccion);
            Redirect::redirect("edicion?id=$edicion");
        }
    }

    public function ajaxSecciones(){
        $edicion = $_GET["edicion"];
        $seccionesDisponibles =  $this->model->getSeccionesFaltantesByEdicion($edicion);

        echo "<label for='seccion'>Elegi una seccion:</label>";
        echo "<select name='seccion' class='w3-input w3-light-grey w3-margin-top'>";
        foreach ($seccionesDisponibles as $seccion){
            echo "<option value='" . $seccion['id'].  "'>" . $seccion['descripcion'] . "</option>";
        }
        echo "</select>";
    }

    public function ajaxSeccionesPorEdicion(){
        $edicion = $_GET["edicion"];
        $seccionesEncontradas =  $this->model->getAjaxSeccionesByEdicion($edicion);

        echo "<label for='seccion'>Seccion a la que pertenece:</label>";
        echo "<select name='seccion' class='w3-input w3-light-grey w3-margin-top'>";
        var_dump($seccionesEncontradas);
        foreach ($seccionesEncontradas as $seccion){
            echo "<option value='" . $seccion['id'].  "'>" . $seccion['descripcion'] . "</option>";
        }
        echo "</select>";
    }

    public function misnoticias()
    {
        $data['noticias'] = true;
        $idContenidista = $_SESSION['usuario'][0]['id'];
        $data['listaNoticias'] = $this->model->getNoticiasByAutor($idContenidista);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function misproductos()
    {
        $data['productos'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function edicion()
    {
        $data['edicion'] = true;
        $idEdicion = $_GET['id'];
        $data['nombre'] = $this->model->getNombreEdicionById($idEdicion);
        $data['listaSecciones'] = $this->model->getSeccionesByEdicion($idEdicion);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function producto()
    {
        $data['ediciones'] = true;
        $idProducto = $_GET['id'];
        $data['nombre'] = $this->model->getNombreProductoById($idProducto);
        $data['listaEdiciones'] = $this->model->getEdicionesByProducto($idProducto);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function validarNoticia(){
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        $imagen1 = $_FILES['imagen1']['tmp_name'];
        $contenido  = $_POST["contenido"];
        $seccion = $_POST["seccion"];
        $edicion = $_POST["edicion"];
        $latitud = $_POST["latitud"];
        $longitud = $_POST["longitud"];

        if(!empty($titulo) && !empty($subtitulo) && !empty($imagen1) && !empty($contenido) && !empty($seccion) && !empty($edicion) && !empty($latitud) && !empty($longitud)){
            return true;
        }
        return false;
    }
}
