<?php

class LectorModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getEdicionesSuscrito($usuario){
        $sql = "SELECT e.id, e.portada, e.edicion, e.producto FROM edicion e JOIN producto p on e.producto = p.id 
                                        JOIN suscripcion s ON s.producto_id = p.id
                                        WHERE s.usuario_id = '$usuario'
                                        AND DATE_FORMAT(e.fecha, '%d-%m-%Y') BETWEEN DATE_FORMAT(s.fechaAdquirido, '%d-%m-%Y') 
                                        AND DATE_FORMAT(s.fechaVencimiento, '%d-%m-%Y')
                GROUP BY e.id, e.portada, e.edicion, e.producto";
        return $this->database->query($sql);
    }

    public function getEdicionesCompradas($usuario){
        $sql = "SELECT e.id, e.portada, e.edicion, e.producto FROM Edicion e
                WHERE EXISTS (SELECT 1
                                FROM compra c
                                WHERE c.edicion_id = e.id
                                AND c.usuario_id = '$usuario')
                GROUP BY e.id, e.portada, e.edicion, e.producto";
        return $this->database->query($sql);
    }

    public function getSuscripciones($usuario){
        $sql = "SELECT p.nombre ,DATE_FORMAT(s.fechaAdquirido, '%d/%m/%Y %h:%m') as fechaAdquirido, 
                DATE_FORMAT(s.fechaVencimiento, '%d/%m/%Y %h:%m') as fechaVencimiento, p.precio 
                FROM suscripcion s JOIN usuarios u on s.usuario_id = u.id
                                            JOIN producto p ON s.producto_id = p.id
                                            WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getSuscripcionesPDF($usuario, $fechaInicio, $fechaFin){
        $sql = "SELECT p.nombre ,DATE_FORMAT(s.fechaAdquirido, '%d/%m/%Y %h:%m') as fechaAdquirido, 
                DATE_FORMAT(s.fechaVencimiento, '%d/%m/%Y %h:%m') as fechaVencimiento, p.precio 
                FROM suscripcion s JOIN usuarios u on s.usuario_id = u.id
                                    JOIN producto p ON p.id = s.producto_id
                                    WHERE u.id = '$usuario'
                                    AND DATE_FORMAT(s.fechaAdquirido, '%Y-%m-%d') BETWEEN '$fechaInicio' AND '$fechaFin'";
        return $this->database->query($sql);
    }

    public function getCompras($usuario){
        $sql = "SELECT p.nombre as nombre, e.edicion, DATE_FORMAT(c.fecha, '%d/%m/%Y %h:%m') as fecha, e.precio 
                FROM compra c JOIN usuarios u on c.usuario_id = u.id
                            JOIN edicion e ON c.edicion_id = e.id
                            JOIN producto p ON p.id = e.producto
                            WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getComprasPDF($usuario, $fechaInicio, $fechaFin){
        $sql = "SELECT p.nombre as nombre, e.edicion, DATE_FORMAT(c.fecha,'%d-%m-%Y %h:%m') as fecha, e.precio 
                FROM compra c JOIN usuarios u on c.usuario_id = u.id
                            JOIN edicion e ON c.edicion_id = e.id
                            JOIN producto p ON p.id = e.producto
                            WHERE u.id = '$usuario' 
                            AND DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$fechaInicio' AND '$fechaFin'";
        return $this->database->query($sql);
    }

    public function getProductoPorId($idProducto){
        $sql = "SELECT * FROM producto WHERE id = '$idProducto'";
        return $this->database->query($sql);
    }

}