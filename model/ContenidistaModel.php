<?php

class ContenidistaModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function altaNoticia($titulo, $subtitulo, $imagen, $contenido, $seccion, $edicion){
        $imagen = '/imagen.png';
        $estado = "pendiente";
        $multimediasql = "INSERT INTO contenido_multimedia (multimedia, multimedia2, multimedia3, multimedia4, multimedia5) VALUES('$imagen', '', '', '', '')";

        $idMultimedia = $this->database->insert($multimediasql);

        $sql = "INSERT INTO contenido (titulo, subtitulo, contenido, imagen, estado, seccion, edicion) VALUES('$titulo', '$subtitulo', '$contenido', '$idMultimedia', '$estado', '$seccion', '$edicion')";

        return $this->database->execute($sql);
    }

    public function altaProducto($nombre, $tipo){
        $sql = "INSERT INTO producto (nombre, tipo) VALUES ('$nombre', '$tipo')";
        return $this->database->execute($sql);
    }

    public function altaEdicion($edicion, $precio, $producto){
        $sql = "INSERT INTO edicion (edicion, precio, producto) VALUES ('$edicion', '$precio', '$producto')";
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

    public function getEdiciones(){
        $sql = "SELECT * FROM edicion";
        return $this->database->query($sql);
    }

    public function getSecciones(){
        $sql = "SELECT * FROM seccion";
        return $this->database->query($sql);
    }
}