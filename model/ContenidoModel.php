<?php

class ContenidoModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getContenido() {
        $sql = 'SELECT * FROM contenido';
        return $this->database->query($sql);
    }

    public function getContenidoPorId($id) {

        $sql = "SELECT * FROM contenido WHERE id = '".$id."' ";
        return $this->database->query($sql);
    }
}