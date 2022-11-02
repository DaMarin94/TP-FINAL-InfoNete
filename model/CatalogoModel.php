<?php

class CatalogoModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getProductos(){
        $sql = "SELECT * FROM producto";
        return $this->database->query($sql);
    }

    public function getNombreProductoPorId($idProducto){
        $sql = "SELECT nombre FROM producto WHERE id = '$idProducto'";
        return $this->database->query($sql);
    }

    public function getNombreEdicionPorId($idEdicion){
        $sql = "SELECT edicion FROM edicion WHERE id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getEdicionesPorProducto($idProducto){
        $sql = "SELECT * FROM edicion WHERE producto = '$idProducto'";
        return $this->database->query($sql);
    }

    public function getSeccionesPorEdicion($idEdicion){
        $sql = "SELECT s.descripcion, s.id FROM seccion s JOIN edicion_seccion es ON s.id = es.seccion 
                                                    JOIN edicion e ON e.id = es.edicion 
                                                    WHERE e.id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getContenidoPorEdicionSeccion($idSeccion, $idEdicion) {
        $sql = "SELECT c.id, c.titulo FROM contenido c JOIN edicion_seccion_noticia esn ON c.id = esn.noticia
                    WHERE esn.edicion = '$idEdicion' 
                    AND esn.seccion = '$idSeccion'";
        return $this->database->query($sql);
    }

    public function getNombreSeccionPorId($idSeccion){
        $sql = "SELECT * FROM seccion WHERE id = '$idSeccion'";
        return $this->database->query($sql);
    }

    public function getContenidoPorId($idContenido) {
        $sql = "SELECT * FROM contenido WHERE id = '$idContenido' ";
        return $this->database->query($sql);
    }

}