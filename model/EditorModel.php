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
        $sql = "SELECT * FROM contenido";
        return $this->database->query($sql);
    }

}