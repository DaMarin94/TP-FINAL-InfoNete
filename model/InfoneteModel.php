<?php

class InfoneteModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getContenido() {
        $sql = 'SELECT * FROM contenido';
        return $this->database->query($sql);
    }
}