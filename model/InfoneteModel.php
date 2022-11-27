<?php

class InfoneteModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getProductos(){
        $sql = "SELECT * FROM producto WHERE alta = 1";
        return $this->database->query($sql);
    }

    public function getProductoPorId($idProducto){
        $sql = "SELECT * FROM producto WHERE id = '$idProducto'";
        return $this->database->query($sql);
    }

    public function getEdicionPorId($idEdicion){
        $sql = "SELECT * FROM edicion WHERE id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getEdicionesPorProducto($idProducto){
        $sql = "SELECT * FROM edicion WHERE producto = '$idProducto' AND alta = 1";
        return $this->database->query($sql);
    }

    public function getSeccionesPorEdicion($idEdicion){
        $sql = "SELECT s.descripcion, s.id FROM seccion s JOIN edicion_seccion es ON s.id = es.seccion 
                                                    JOIN edicion e ON e.id = es.edicion 
                                                    WHERE e.id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getContenidoSuscritoPorEdicionSeccion($usuario, $idSeccion, $idEdicion) {
        $sql = "SELECT c.id, c.titulo, c.subtitulo, c.contenido, c.multimedia, c.latitud, c.longitud, 
                       cm.imagen1, cm.imagen2, cm.imagen3, cm.audio, cm.video, cm.url 
                FROM contenido c JOIN contenido_multimedia cm ON c.multimedia = cm.id
                                JOIN edicion_seccion_noticia esn ON c.id = esn.noticia
                                JOIN edicion e ON e.id = esn.edicion
                                JOIN suscripcion s ON s.producto_id = e.producto
                    WHERE esn.edicion = '$idEdicion' 
                    AND esn.seccion = '$idSeccion'
                    AND s.usuario_id = $usuario
                    AND c.estado = 2
                    AND e.fecha BETWEEN DATE_FORMAT(s.fechaAdquirido, '%d-%m-%Y') 
                                AND DATE_FORMAT(s.fechaVencimiento, '%d-%m-%Y')";
        return $this->database->query($sql);
    }

    public function getContenidoCompradoPorEdicionSeccion($usuario, $idSeccion, $idEdicion) {
        $sql = "SELECT c.id, c.titulo, c.subtitulo, c.contenido, c.multimedia, c.latitud, c.longitud, 
                       cm.imagen1, cm.imagen2, cm.imagen3, cm.audio, cm.video, cm.url 
                FROM contenido c JOIN edicion_seccion_noticia esn ON c.id = esn.noticia
                                JOIN contenido_multimedia cm ON c.multimedia = cm.id
                                JOIN edicion e ON e.id = esn.edicion
                                JOIN compra co ON co.edicion_id = e.id
                    WHERE esn.edicion = '$idEdicion' 
                    AND esn.seccion = '$idSeccion'
                    AND co.usuario_id = $usuario
                    AND c.estado = 2";
        return $this->database->query($sql);
    }

    public function getNoticiasPorEdicion($idEdicion) {
        $sql = "SELECT * FROM contenido c JOIN edicion_seccion_noticia esn ON c.id = esn.noticia
                WHERE esn.edicion = '$idEdicion'" ;
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

    public function suscribirseProducto($idProducto, $usuario) {

        $usuarioYaSuscritoVerificacion = "SELECT * FROM suscripcion s WHERE s.producto_id = '$idProducto'
                                                    AND  s.usuario_id = '$usuario'";
        $usuarioYaSuscrito = $this->database->query($usuarioYaSuscritoVerificacion);
        if(count($usuarioYaSuscrito) > 0){
            return false;
        }

        $sql = "INSERT INTO suscripcion(usuario_id, producto_id, fechaVencimiento)
                VALUES($usuario, $idProducto, NOW() + INTERVAL 1 MONTH)";

        return $this->database->execute($sql);
    }

    public function comprarEdicion($idEdicion, $usuario) {

        $usuarioYaComproVerificacion = "SELECT * FROM compra c WHERE c.edicion_id = '$idEdicion'
                                                    AND  c.usuario_id = '$usuario'";
        $usuarioYaCompro = $this->database->query($usuarioYaComproVerificacion);
        if(count($usuarioYaCompro) > 0){
            return false;
        }

        $usuarioYaSuscritoVerificacion = "SELECT e.id, e.portada, e.edicion FROM edicion e JOIN producto p on e.producto = p.id 
                                                JOIN suscripcion s ON s.producto_id = p.id
                                                WHERE s.usuario_id = '$usuario'
                                                AND s.producto_id =  e.producto
                                                AND e.fecha BETWEEN s.fechaAdquirido AND s.fechaVencimiento
                                                AND e.id = '$idEdicion'";
        $usuarioYaSuscrito = $this->database->query($usuarioYaSuscritoVerificacion);
        if(count($usuarioYaSuscrito) > 0){
            return false;
        }

        $sql = "INSERT INTO compra(usuario_id, edicion_id)
                VALUES($usuario, $idEdicion)";

        return $this->database->execute($sql);
    }

    public function getProductosSuscrito($usuario) {
        $sql = "SELECT s.producto_id 
                    FROM suscripcion s WHERE s.usuario_id = '$usuario' ";
        return $this->database->query($sql);
    }

    public function getClima(){

    }

    public function getEdicionComprada($idEdicion, $usuario){

        $sql = " SELECT c.edicion_id 
                FROM compra c
                        WHERE c.usuario_id = '$usuario'
                        AND c.edicion_id = '$idEdicion'";
        return $this->database->query($sql);
    }

    public function getProductoSuscrito($idEdicion, $usuario){

        $sql = " SELECT s.producto_id 
                    FROM suscripcion s JOIN edicion e ON s.producto_id = e.producto
                            WHERE s.usuario_id = '$usuario'
                            AND e.id = '$idEdicion'
                            AND DATE_FORMAT(e.fecha, '%d-%m-%Y') BETWEEN DATE_FORMAT(s.fechaAdquirido, '%d-%m-%Y') 
                                        AND DATE_FORMAT(s.fechaVencimiento, '%d-%m-%Y')";
        return $this->database->query($sql);
    }

    public function getContenidoEdicionSeccion($idSeccion, $idEdicion) {
        $sql = "SELECT c.id, c.titulo, c.subtitulo, c.contenido, c.multimedia, c.latitud, c.longitud, 
                       cm.imagen1, cm.imagen2, cm.imagen3, cm.audio, cm.video, cm.url 
                FROM contenido c JOIN edicion_seccion_noticia esn ON c.id = esn.noticia
                                JOIN contenido_multimedia cm ON c.multimedia = cm.id
                                JOIN edicion e ON e.id = esn.edicion
                    WHERE esn.edicion = '$idEdicion'
                    AND esn.seccion = '$idSeccion'
                    AND c.estado = 2";
        return $this->database->query($sql);
    }

}