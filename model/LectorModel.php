<?php

class LectorModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getProductosComprados($usuario){
        $sql = "SELECT * FROM suscripcion s JOIN usuarios u ON s.usuario_id = u.id
                                            JOIN producto p ON s.producto_id = p.id
                                            WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getEdicionesCompradas($usuario){

        $sql = "SELECT * FROM Edicion e
                WHERE  EXISTS (SELECT 1
                                FROM producto p
                                WHERE  EXISTS (SELECT 1
                                                FROM suscripcion s
                                                WHERE s.producto_id = p.id
                                                AND p.id = e.producto
                                                AND s.usuario_id = '$usuario'
                                                AND e.fecha BETWEEN s.fechaAdquirido AND s.fechaVencimiento));";
        return $this->database->query($sql);
    }

    public function getSuscripciones($usuario){

        $sql = "SELECT * FROM suscripcion s JOIN usuarios u on s.usuario_id = u.id
                                            WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }

    public function getNoticiasCompradas($usuario){

        $sql = "SELECT * FROM contenido c JOIN edicion_seccion_noticia esn on esn.noticia = c.id
                                        JOIN edicion e ON e.id = esn.edicion
                                        JOIN producto p ON p.id = e.producto 
                                        JOIN suscripcion s ON s.producto_id = p.id
                                        JOIN usuarios u ON u.id = s.usuario_id
                                        WHERE u.id = '$usuario'";
        return $this->database->query($sql);
    }
}