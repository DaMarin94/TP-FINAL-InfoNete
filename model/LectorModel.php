<?php

class LectorModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getProductosSuscrito($usuario){
        $sql = "SELECT p.id, p.portada FROM suscripcion s JOIN usuarios u ON s.usuario_id = u.id
                                            JOIN producto p ON s.producto_id = p.id
                                            WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getProductosCompras($usuario){
        $sql = "SELECT p.id, p.portada FROM compra c JOIN edicion e ON c.edicion_id = e.id
                                        JOIN producto p ON e.producto = p.id
                                        WHERE c.usuario_id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getEdicionesSuscrito($usuario, $idProducto){
        $sql = "SELECT e.id, e.portada, e.edicion FROM edicion e JOIN producto p on e.producto = p.id 
                                        JOIN suscripcion s ON s.producto_id = p.id
                                        WHERE s.usuario_id = '$usuario'
                                        AND s.producto_id = '$idProducto'
                                        AND e.fecha BETWEEN s.fechaAdquirido AND s.fechaVencimiento";
        return $this->database->query($sql);
    }

    public function getEdicionesCompradas($usuario, $idProducto){

        $sql = "SELECT * FROM Edicion e
                WHERE e.producto = '$idProducto'
                AND EXISTS (SELECT 1
                                FROM compra c
                                WHERE c.edicion_id = e.id
                                AND c.usuario_id = '$usuario')";
        return $this->database->query($sql);
    }

    public function getSuscripciones($usuario){

        $sql = "SELECT * FROM suscripcion s JOIN usuarios u on s.usuario_id = u.id
                                            JOIN producto p ON s.producto_id = p.id
                                            WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getCompras($usuario){

        $sql = "SELECT * FROM compra c JOIN usuarios u on c.usuario_id = u.id
                                        JOIN edicion e ON c.edicion_id = e.id
                                            WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getSuscripcionesPDF($usuario, $fechaInicio, $fechaFin){

        $sql = "SELECT * FROM suscripcion s JOIN usuarios u on s.usuario_id = u.id
                                            JOIN producto p ON p.id = s.producto_id
                                            WHERE u.id = '$usuario'
                                            AND s.fechaAdquirido BETWEEN '$fechaInicio' AND '$fechaFin'
                                            OR s.fechaVencimiento BETWEEN '$fechaInicio' AND '$fechaFin'";
        return $this->database->query($sql);
    }

    public function getComprasPDF($usuario, $fechaInicio, $fechaFin){

        $sql = "SELECT * FROM compra c JOIN usuarios u on c.usuario_id = u.id
                                        JOIN edicion e ON c.edicion_id = e.id
                                        WHERE u.id = '$usuario'
                                        AND c.fechaCompra BETWEEN '$fechaInicio' AND '$fechaFin'";
        return $this->database->query($sql);
    }

    public function getNoticiasSuscrito($usuario){

        $sql = "SELECT * FROM contenido c JOIN edicion_seccion_noticia esn on esn.noticia = c.id
                                        JOIN edicion e ON e.id = esn.edicion
                                        JOIN producto p ON p.id = e.producto 
                                        JOIN suscripcion s ON s.producto_id = p.id
                                        JOIN usuarios u ON u.id = s.usuario_id
                                        WHERE u.id = '$usuario'
                                        AND e.fecha BETWEEN s.fechaAdquirido AND s.fechaVencimiento";
        return $this->database->query($sql);
    }

    public function getNoticiasCompradas($usuario){

        $sql = "SELECT DISTINCT * FROM contenido c JOIN edicion_seccion_noticia esn on esn.noticia = c.id
                                        JOIN edicion e ON e.id = esn.edicion
                                        JOIN compra co ON co.edicion_id = e.id
                                        JOIN usuarios u ON u.id = co.usuario_id
                                        WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getProductoPorId($idProducto){
        $sql = "SELECT * FROM producto WHERE id = '$idProducto'";
        return $this->database->query($sql);
    }

}