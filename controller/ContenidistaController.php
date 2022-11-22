<?php

class ContenidistaController
{

    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
        if(!Router::checkAuth([2])){
            Redirect::redirect('/');
        };
    }

    //Primera vista del contenidista
    public function list(){
        $this->noticiasBorrador();
    }

    //Metodos relacionados al formulario de AGREGAR PRODUCTO
    public function formularioProducto(){
        $data['exito'] = $this->mensajeExitoProducto();
        $data['error'] = $this->mensajeErrorProducto();

        $data['formAltaProducto'] = true;
        $data['tipos'] = $this->model->getTipos();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarProducto(){
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $precio = $_POST["precio"];

        $imagen =  $_FILES['portada']['name'];
        $portada = $_FILES['portada']['tmp_name'];

        if(!empty($nombre) && !empty($tipo) && !empty($imagen) && !empty($precio)){
            $this->validarImagen($imagen, $portada);
            $this->model->altaProducto($nombre, $tipo, $imagen, $precio);
            Redirect::redirect("formularioProducto?exito=true");
        } else {
            $this->errorProducto();
        }
    }

    public function errorProducto(){
        if (empty($_POST["nombre"])){
            Redirect::redirect("formularioProducto?error=nombre");
        }
        if (empty($_FILES['portada']['name'])){
            Redirect::redirect("formularioProducto?error=imagen");
        }
        if (empty($_POST["precio"])){
            Redirect::redirect("formularioProducto?error=precio");
        }
    }

    public function validarImagen($imagen, $portada){
        //Ultimos 3 caracteres de la cadena
        $sub=substr($imagen, -3);
        //Validacion de imagen en png o jpeg
        if($sub == "jpg"){
            move_uploaded_file($portada, "public/images/".$imagen);
        }
        if($sub == "jpeg"){
            move_uploaded_file($portada, "public/images/".$imagen);
        }
        if($sub == "png"){
            move_uploaded_file($portada, "public/images/".$imagen);
        }
        if($sub != "jpg" && $sub && "png" && $sub != "jpeg"){
            Redirect::redirect("formularioProducto?error=formatoimagen");
        }
    }

    public function mensajeExitoProducto(){
        $mensaje = "";
        if (isset($_GET["exito"]) && $_GET["exito"] == true){
            $mensaje = "El producto se ha registrado con exito!";
        }
        return $mensaje;
    }

    public function mensajeErrorProducto(){
        $mensaje = "";
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "nombre") {
                $mensaje = $mensaje . "Error: El campo 'Nombre' es obligatorio";
            }
            if ($_GET["error"] == "precio") {
                $mensaje = $mensaje . "Error: El campo 'precio' es obligatorio";
            }
            if ($_GET["error"] == "imagen") {
                $mensaje = $mensaje . "Error: imagen no insertada";
            }
            if ($_GET["error"] == "formatoimagen") {
                $mensaje = $mensaje . "Error: Formato de imagen invalido, debe ser JPG, JPEG o PNG";
            }
            return $mensaje;
        }
    }

    //Metodos relacionados al formulario de AGREGAR EDICION
    public function formularioEdicion(){
        $data['exito'] = $this->mensajeExitoEdicion();
        $data['error'] = $this->mensajeErrorEdicion();

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
            $this->validarImagen($imagen, $portada);
            $this->model->altaEdicion($edicion, $precio, $producto, $imagen);
            Redirect::redirect("formularioEdicion?exito=true");
        } else {
            $this->errorEdicion();
        }
    }

    public function errorEdicion(){
        if (empty($_POST["edicion"])) {
            Redirect::redirect("formularioEdicion?error=edicion");
        }
        if (empty($_POST["precio"])) {
            Redirect::redirect("formularioEdicion?error=precio");
        }
        if (empty($_POST["producto"])) {
            Redirect::redirect("formularioEdicion?error=producto");
        }
        if (empty($_FILES['portada']['name'])) {
            Redirect::redirect("formularioEdicion?error=imagen");
        }
    }

    public function mensajeExitoEdicion(){
        $mensaje = "";
        if (isset($_GET["exito"]) && $_GET["exito"] == true){
            $mensaje = "La edicion se ha registrado con exito!";
        }
        return $mensaje;
    }

    public function mensajeErrorEdicion(){
        $mensaje = "";
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "edicion") {
                $mensaje = $mensaje . "Error: El campo 'Edicion' es obligatorio";
            }
            if ($_GET["error"] == "precio") {
                $mensaje = $mensaje . "Error: El campo 'Precio' es obligatorio";
            }
            if ($_GET["error"] == "imagen") {
                $mensaje = $mensaje . "Error: imagen no insertada";
            }
            if ($_GET["error"] == "formatoimagen") {
                $mensaje = $mensaje . "Error: Formato de imagen invalido, debe ser JPG, JPEG o PNG";
            }
            return $mensaje;
        }
    }

    //Metodos relacionados a formulario de AGREGAR SECCION
    public function formularioSeccion(){
        $data['error'] = $this->mensajeErrorSeccion();
        $data['exito'] = $this->mensajeExitoSeccion();

        $data['formAgregarSeccion'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function procesarSeccion(){
        $edicion = $_POST["edicion"];
        $seccion = $_POST["seccion"];

        if(!empty($edicion) && !empty($seccion)){
            $this->model->altaSeccion($edicion, $seccion);
            Redirect::redirect("formularioSeccion?exito=1");
        } else {
            if(empty($edicion)){
                Redirect::redirect("formularioSeccion?error=edicion");
            }
            if(empty($seccion)){
                Redirect::redirect("formularioSeccion?error=seccion");
            }
        }
    }

    public function mensajeErrorSeccion(){
        if (isset($_GET["error"])){
            $mensaje = "";
            if ($_GET["error"] == "edicion"){
                $mensaje = "Error: No se ha seleccionado ninguna edicion";
            }
            if ($_GET["error"] == "seccion"){
                $mensaje = "Error: No se ha seleccionado ninguna seccion";
            }
            return $mensaje;
        }
    }

    public function mensajeExitoSeccion(){
        $mensaje = "";
        if (isset($_GET["exito"]) && $_GET["exito"] == 1){
            $mensaje = "La seccion fue agregada con exito!";
        }
        return $mensaje;
    }

    //Metodos relacionado a AGREGAR NOTICIA y ABM
    public function formularioNoticia(){
        if(!empty($_GET['error'])){
            $data['error'] = $_GET['error'];
        }

        $data['formAltaNoticia'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        echo $this->renderer->render("contenidista.mustache", $data);
    }

    public function procesarNoticia(){
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
            $this->mensajeErrorNoticia();
        }
    }

    public function verNoticia(){
        $idNoticia = $_GET["id"];
        $data['datosNoticia'] = $this->model->getNoticia($idNoticia);
        echo $this->renderer->render("noticia.mustache", $data);
    }

    public function editarNoticia(){
        $idNoticia = $_GET["id"];
        $data['editarNoticia'] = true;
        $data['listaEdiciones'] = $this->model->getEdiciones();
        $data['datosNoticia'] = $this->model->getNoticia($idNoticia);
        echo $this->renderer->render("contenidista.mustache", $data);
    }

    public function procesarEditarNoticia(){
        $idNoticia = $_POST["id"];
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        $contenido  = $_POST["contenido"];
        $latitud = $_POST["latitud"];
        $longitud = $_POST["longitud"];

        $seccion = $_POST["seccion"];
        $edicion = $_POST["edicion"];

        if(true) {
            $this->model->editarNoticia($idNoticia, $titulo, $subtitulo, $contenido, $seccion, $edicion, $latitud, $longitud);
            Redirect::redirect("noticiasBorrador");
        } else {
            Redirect::redirect("editarNoticia?id=$idNoticia");
        }
    }

    public function borrarNoticia(){
        $idNoticia = $_GET["id"];
        $this->model->deleteNoticiaById($idNoticia);
        Redirect::redirect("noticiasBorrador");
    }

    //Metodos AJAX para obtener las secciones
    public function ajaxSecciones(){
        $edicion = $_GET["edicion"];
        $seccionesDisponibles =  $this->model->getSeccionesFaltantesByEdicion($edicion);

        echo "<label for='seccion' class='contenidista-form-label'>Elegi una seccion:</label>";
        echo "<select name='seccion' class='w3-input w3-margin-top contenidista-form-select'>";
        echo "<option value='0'>Seleccione una seccion</option>";
        foreach ($seccionesDisponibles as $seccion){
            echo "<option value='" . $seccion['id'].  "'>" . $seccion['descripcion'] . "</option>";
        }
        echo "</select>";
    }

    public function ajaxSeccionesPorEdicion(){
        $edicion = $_GET["edicion"];
        $seccionesEncontradas =  $this->model->getAjaxSeccionesByEdicion($edicion);

        echo "<label for='seccion'>Seccion a la que pertenece:</label>";
        echo "<select name='seccion' class='w3-input w3-margin-top contenidista-form-select'>";
        var_dump($seccionesEncontradas);
        foreach ($seccionesEncontradas as $seccion){
            echo "<option value='" . $seccion['id'].  "'>" . $seccion['descripcion'] . "</option>";
        }
        echo "</select>";
    }

    //Metodos para obtener las noticias del contenidista segun el estado
    public function noticiasBorrador(){
        $data['noticiasBorrador'] = true;
        $idContenidista = $_SESSION['usuario'][0]['id'];
        $data['listaNoticias'] = $this->model->getNoticiasEnBorradorByAutor($idContenidista);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function noticiasRevision(){
        $data['noticiasRevision'] = true;
        $idContenidista = $_SESSION['usuario'][0]['id'];
        $data['listaNoticias'] = $this->model->getNoticiasRevisadasByAutor($idContenidista);
        $this->renderer->render('contenidista.mustache', $data);
    }

    public function noticiasPublicadas(){
        $data['noticiasPublicadas'] = true;
        $idContenidista = $_SESSION['usuario'][0]['id'];
        $data['listaNoticias'] = $this->model->getNoticiasPublicadasByAutor($idContenidista);
        $this->renderer->render('contenidista.mustache', $data);
    }



    public function validarNoticia(){
        if(empty($_POST["titulo"])){
            return false;
        }
        if(empty($_POST["subtitulo"])){
            return false;
        }
        if(empty($_POST["contenido"])){
            return false;
        }
        if(empty($_POST["seccion"])){
            return false;
        }
        if(empty($_POST["edicion"])){
            return false;
        }
        if(empty($_POST["latitud"])){
            return false;
        }
        if(empty($_POST["longitud"])){
            return false;
        }
        if(empty($_FILES['imagen1']['tmp_name'])){
            return false;
        }
        return true;
    }

    public function mensajeErrorNoticia(){
        $mensaje="";
        if(empty($_POST["titulo"])){
            $mensaje = $mensaje . "Por favor complete el campo 'Titulo'. ";
        }
        if(empty($_POST["subtitulo"])){
            $mensaje = $mensaje . "Por favor complete el campo 'Subtitulo'. ";
        }
        if(empty($_POST["contenido"])){
            $mensaje = $mensaje . "Por favor complete el campo 'Contenido'. ";
        }
        if(empty($_POST["seccion"])){
            $mensaje = $mensaje . "Por favor seleccione una seccion. ";
        }
        if(empty($_POST["edicion"])){
            $mensaje = $mensaje . "Por favor seleccione una edicion. ";
        }
        if(empty($_POST["latitud"])){
            $mensaje = $mensaje . "Por favor marque 'Latitud'. ";
        }
        if(empty($_POST["longitud"])){
            $mensaje = $mensaje . "Por favor marque 'Longitud'. ";
        }
        if(empty($_FILES['imagen1']['tmp_name'])){
            $mensaje = $mensaje . "Por favor inserte la imagen principal'.";
        }
        Redirect::redirect("formularioNoticia?error=$mensaje");
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
