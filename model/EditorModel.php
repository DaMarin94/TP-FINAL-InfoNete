<?php

class EditorModel
{
    private $database;
    private $roles = [];

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getContenidos(){
        $sql = "SELECT * FROM contenido c LEFT JOIN estado e ON c.estado = e.id";
        return $this->database->query($sql);
    }

    // estado 1 -> nuevo, 2 -> verificado, 3 -> revision
    public function getContenidosReportados(){
        $sql = "SELECT * FROM contenido c LEFT JOIN estado e ON c.estado = e.id WHERE c.estado <> 1";
        return $this->database->query($sql);
    }

    public function getContenidosNuevos(){
        $sql = "SELECT * FROM contenido c LEFT JOIN estado e ON c.estado = e.id WHERE c.estado = 1";
        return $this->database->query($sql);
    }
}