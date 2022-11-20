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

    public function validarRol(){
        if(!Router::checkAuth([2])){
            Redirect::redirect('/');
        };
    }

    public function list(){
        $this->validarRol();

        $this->noticiasBorrador();
    }

    public function formularioNoticia(){
        $this->validarRol();

        $data['formAltaNoticia'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        echo $this->renderer->render("contenidista.mustache", $data);
    }

    public function procesarNoticia(){
        $this->validarRol();

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
            Redirect::redirect("noticiasBorrador");
        } else {
            Redirect::redirect("formularioNoticias");
        }
    }

    public function verNoticia(){
        $this->validarRol();

        $idNoticia = $_GET["id"];
        $data['datosNoticia'] = $this->model->getNoticia($idNoticia);
        echo $this->renderer->render("noticia.mustache", $data);
    }

    public function editarNoticia(){
        $this->validarRol();

        $idNoticia = $_GET["id"];
        $data['editarNoticia'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['datosNoticia'] = $this->model->getDatosNoticia($idNoticia);
        $data['datosMultimedia'] = $this->model->getMultimediaByNoticia($idNoticia);
        echo $this->renderer->render("contenidista.mustache", $data);
    }

    public function borrarNoticia(){
        $idNoticia = $_GET["id"];
        $this->model->deleteNoticiaById($idNoticia);
        Redirect::redirect("noticiasBorrador");
    }

    //Metodos relacionados al formulario de AGREGAR PRODUCTO
    public function formularioProducto(){
        $this->validarRol();

        $data['exito'] = $this->mensajeExitoProducto();

        $data['formAltaProducto'] = true;
        $data['tipos'] = $this->model->getTipos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarProducto(){
        $this->validarRol();

        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];

        $imagen =  $_FILES['portada']['name'];
        $portada = $_FILES['portada']['tmp_name'];

        if(!empty($nombre) && !empty($tipo) && !empty($imagen)){
            move_uploaded_file($portada, "public/images/".$imagen);
            $this->model->altaProducto($nombre, $tipo, $imagen);
            Redirect::redirect("formularioProducto?msg=1");
        } else {
            Redirect::redirect("formularioProducto?msg=0");
        }
    }

    public function mensajeExitoProducto(){
        $mensaje = "";
        if (isset($_GET["msg"]) && $_GET["msg"] == 1){
            $mensaje = "El producto fue agregado con exito!";
        }
        return $mensaje;
    }


    public function formularioEdicion(){
        $this->validarRol();

        $data['formAltaEdicion'] = true;
        $data['listaProductos'] = $this->model->getProductos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarEdicion(){
        $this->validarRol();

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

    //Metodos relacionados a formulario de AGREGAR SECCION
    public function formularioSeccion(){
        $this->validarRol();

        $data['error'] = $this->mensajeErrorSeccion();
        $data['exito'] = $this->mensajeExitoSeccion();

        $data['formAgregarSeccion'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarSeccion(){
        $this->validarRol();

        $edicion = $_POST["edicion"];
        $seccion = $_POST["seccion"];

        if(!empty($edicion) && !empty($seccion)){
            $this->model->altaSeccion($edicion, $seccion);
            Redirect::redirect("formularioSeccion?msg=1");
        } else {
            Redirect::redirect("formularioSeccion?msg=0");
        }
    }

    //Se paso por url un parametro para poder mostrar un mensaje en
    //respuesta al envio del form
    public function mensajeErrorSeccion(){
        if (isset($_GET["msg"]) && $_GET["msg"] == 0){
            if(!isset($_POST["edicion"])) {
                return "Por favor, seleccione una edicion";
            }

            if(!isset($_POST["seccion"])){
                return "Por favor, seleccione una seccion";
            }
        }
    }

    public function mensajeExitoSeccion(){
        $mensaje = "";
        if (isset($_GET["msg"]) && $_GET["msg"] == 1){
            $mensaje = "La seccion fue agregada con exito!";
        }
        return $mensaje;
    }

    //Metodos AJAX para obtener las secciones
    public function ajaxSecciones(){
        $this->validarRol();

        $edicion = $_GET["edicion"];
        $seccionesDisponibles =  $this->model->getSeccionesFaltantesByEdicion($edicion);

        echo "<label for='seccion'>Elegi una seccion:</label>";
        echo "<select name='seccion' class='w3-input w3-light-grey w3-margin-top'>";
        echo "<option value='0'>Seleccione una seccion</option>";
        foreach ($seccionesDisponibles as $seccion){
            echo "<option value='" . $seccion['id'].  "'>" . $seccion['descripcion'] . "</option>";
        }
        echo "</select>";
    }

    public function ajaxSeccionesPorEdicion(){
        $this->validarRol();

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

    //Metodos para obtener las noticias del contenidista segun el estado
    public function noticiasBorrador(){
        $this->validarRol();

        $data['noticiasBorrador'] = true;
        $idContenidista = $_SESSION['usuario'][0]['id'];
        $data['listaNoticias'] = $this->model->getNoticiasEnBorradorByAutor($idContenidista);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function noticiasRevision(){
        $this->validarRol();

        $data['noticiasRevision'] = true;
        $idContenidista = $_SESSION['usuario'][0]['id'];
        $data['listaNoticias'] = $this->model->getNoticiasRevisadasByAutor($idContenidista);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function noticiasPublicadas(){
        $this->validarRol();

        $data['noticiasPublicadas'] = true;
        $idContenidista = $_SESSION['usuario'][0]['id'];
        $data['listaNoticias'] = $this->model->getNoticiasPublicadasByAutor($idContenidista);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function producto(){
        $this->validarRol();

        $data['ediciones'] = true;
        $idProducto = $_GET['id'];
        $data['nombre'] = $this->model->getNombreProductoById($idProducto);
        $data['listaEdiciones'] = $this->model->getEdicionesByProducto($idProducto);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function validarNoticia(){
        $this->validarRol();

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

    /*public function misproductos(){
    $this->validarRol();

    $data['productos'] = true;
    $data['listaProductos'] = $this->model->getProductos();
    $this->renderer->render('contenidista.mustache', $data);
    }

    public function edicion(){
        $this->validarRol();

        $data['edicion'] = true;
        $idEdicion = $_GET['id'];
        $data['nombre'] = $this->model->getNombreEdicionById($idEdicion);
        $data['listaSecciones'] = $this->model->getSeccionesByEdicion($idEdicion);
        $this->renderer->render('contenidista.mustache', $data);
    }*/
}
