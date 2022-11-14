<?php

class ContenidistaModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function altaNoticia($titulo, $subtitulo, $idMultimedia, $contenido, $seccion, $edicion, $latitud, $longitud){
        $estado = 1;
        $contenidista = $_SESSION['usuario'][0]['id'];
        $sql1 = "INSERT INTO contenido (titulo, subtitulo, contenido, multimedia, estado, latitud, longitud, contenidista) VALUES('$titulo', '$subtitulo', '$contenido', '$idMultimedia', '$estado', '$latitud', '$longitud', '$contenidista')";
        $noticia = $this->database->insert($sql1);
        $sql2 = "INSERT INTO edicion_seccion_noticia (edicion, seccion, noticia) VALUES('$edicion', '$seccion', '$noticia')";
        return $this->database->execute($sql2);
    }

    public function procesarMultimedia()
    {
        $imagenName1 = $_FILES['imagen1']['name'];
        $imagenTmp1 = $_FILES['imagen1']['tmp_name'];
        if (!is_null($imagenTmp1)) {
            move_uploaded_file($imagenTmp1, "public/images/" . $imagenName1);
        }

        $imagenName2 = $_FILES['imagen2']['name'];
        $imagenTmp2 = $_FILES['imagen2']['tmp_name'];
        if (!is_null($imagenTmp2)) {
            move_uploaded_file($imagenTmp2, "public/images/" . $imagenName2);
        }

        $imagenName3 = $_FILES['imagen3']['name'];
        $imagenTmp3 = $_FILES['imagen3']['tmp_name'];
        if (!is_null($imagenTmp3)) {
            move_uploaded_file($imagenTmp3, "public/images/" . $imagenName3);
        }

        $video = $_FILES['video']['tmp_name'];
        if (!is_null($video)) {
            $videoName = uniqid().".mp4";
            move_uploaded_file($video, "public/multimedia/" . $videoName);
        }

        $audio = $_FILES['audio']['tmp_name'];
        if (!is_null($audio)){
           $audioName = uniqid().".webm";
           move_uploaded_file($audio, "public/multimedia/" . $audioName);
        }

        $url = $_POST['url'];

        $multimediasql = "INSERT INTO contenido_multimedia (imagen1, imagen2, imagen3, audio, video, url) VALUES('$imagenName1', '$imagenName2', '$imagenName3', '$videoName', '$audioName', '$url')";
        return $this->database->insert($multimediasql);
    }

    public function altaProducto($nombre, $tipo, $portada){
        $sql = "INSERT INTO producto (nombre, tipo, portada) VALUES ('$nombre', '$tipo', '$portada')";
        return $this->database->execute($sql);
    }

    public function altaEdicion($edicion, $precio, $producto, $portada){
        $sql = "INSERT INTO edicion (edicion, precio, producto, portada) VALUES ('$edicion', '$precio', '$producto', '$portada')";
        return $this->database->execute($sql);
    }

    public function altaSeccion($edicion, $seccion){
        $sql = "INSERT INTO edicion_seccion (edicion, seccion) VALUES ('$edicion', '$seccion')";
        return $this->database->execute($sql);
    }

    public function getTipos(){
        $sql = "SELECT * FROM tipo";
        return $this->database->query($sql);
    }

    public function getNoticiasByAutor($idContenidista){
        $sql = "SELECT * FROM contenido WHERE contenidista = '$idContenidista'";
        return $this->database->query($sql);
    }

    public function getProductos(){
        $sql = "SELECT * FROM producto";
        return $this->database->query($sql);
    }

    public function getNombreProductoById($idProducto){
        $sql = "SELECT nombre FROM producto WHERE id = '$idProducto'";
        return $this->database->query($sql);
    }

    public function getEdiciones(){
        $sql = "SELECT * FROM edicion";
        return $this->database->query($sql);
    }

    public function getNombreEdicionById($idEdicion){
        $sql = "SELECT edicion FROM edicion WHERE id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getEdicionesByProducto($idProducto){
        $sql = "SELECT * FROM edicion WHERE producto = '$idProducto'";
        return $this->database->query($sql);
    }

    public function getSecciones(){
        $sql = "SELECT * FROM seccion";
        return $this->database->query($sql);
    }

    public function getSeccionesByEdicion($idEdicion){
        $sql = "SELECT s.descripcion FROM seccion s JOIN edicion_seccion es ON s.id = es.seccion 
                                                    JOIN edicion e ON e.id = es.edicion 
                                                    WHERE e.id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getAjaxSeccionesByEdicion($idEdicion){
        $sql = "SELECT * FROM seccion s JOIN edicion_seccion es ON s.id = es.seccion 
                                                    JOIN edicion e ON e.id = es.edicion 
                                                    WHERE e.id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getSeccionesFaltantesByEdicion($idEdicion){
        $sql = "SELECT *
                FROM seccion s
                WHERE NOT EXISTS (SELECT 1
				                    FROM edicion e JOIN edicion_seccion es ON e.id = es.edicion
                                    WHERE e.id = '$idEdicion'
                                    AND s.id = es.seccion)";
        return $this->database->query($sql);
    }

    public function getDatosNoticia($noticia){
        $sql = "SELECT * FROM contenido WHERE id = '$noticia'";
        return $this->database->query($sql);
    }

    public function getMultimediaByNoticia($noticia){
        $sql = "SELECT * FROM contenido_multimedia cm JOIN contenido c ON c.multimedia = cm.id 
                                                      WHERE c.id = '$noticia'";
        return $this->database->query($sql);
    }
}