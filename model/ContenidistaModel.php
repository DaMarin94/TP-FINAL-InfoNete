<?php

class ContenidistaModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function altaNoticia($titulo, $subtitulo, $imagen, $contenido, $seccion, $edicion){
        $estado = 2;
        $multimediasql = "INSERT INTO contenido_multimedia (imagen1, imagen2, imagen3, audio, video) VALUES('$imagen', '', '', '', '')";
        $idMultimedia = $this->database->insert($multimediasql);

        $sql1 = "INSERT INTO contenido (titulo, subtitulo, contenido, imagen, estado) VALUES('$titulo', '$subtitulo', '$contenido', '$idMultimedia', '$estado')";
        $noticia = $this->database->insert($sql1);

        $sql2 = "INSERT INTO edicion_seccion_noticia (edicion, seccion, noticia) VALUES('$edicion', '$seccion', '$noticia')";
        return $this->database->execute($sql2);
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

    public function getNoticias(){
        $sql = "SELECT * FROM contenido";
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

}